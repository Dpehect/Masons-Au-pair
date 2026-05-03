import psutil
import requests
import time
import subprocess
import os
import logging
from datetime import datetime

# Configuration
CONFIG = {
    'thresholds': {
        'cpu_percent': 90,
        'ram_percent': 85,
        'disk_percent': 90
    },
    'services': ['nginx', 'php-fpm', 'mosquitto'],
    'slack_webhook': 'https://hooks.slack.com/services/YOUR/WEBHOOK/URL',
    'log_path': '/var/www/html/storage/logs/laravel.log',
    'check_interval': 30
}

"""
MasonsMonitor: A lightweight reliability engineering tool designed to ensure 99.9% uptime.
It proactively monitors system resources, validates service health (Nginx, PHP-FPM, MQTT),
and performs real-time log analysis to trigger automated self-healing procedures.
"""

class MasonsMonitor:
    def __init__(self):
        self.last_log_size = 0
        if os.path.exists(CONFIG['log_path']):
            self.last_log_size = os.path.getsize(CONFIG['log_path'])

    def send_alert(self, message):
        payload = {"text": f"🚨 *Masons Reliability Alert* 🚨\n{message}"}
        try:
            requests.post(CONFIG['slack_webhook'], json=payload)
            logging.warning(f"Alert sent: {message}")
        except Exception as e:
            logging.error(f"Failed to send alert: {str(e)}")

    def check_system_stats(self):
        cpu = psutil.cpu_percent(interval=1)
        ram = psutil.virtual_memory().percent
        disk = psutil.disk_usage('/').percent

        if cpu > CONFIG['thresholds']['cpu_percent']:
            self.send_alert(f"High CPU Usage: {cpu}%")
        
        if ram > CONFIG['thresholds']['ram_percent']:
            self.send_alert(f"High RAM Usage: {ram}%")

    def check_services(self):
        for service in CONFIG['services']:
            status = subprocess.run(['systemctl', 'is-active', service], capture_output=True, text=True).stdout.strip()
            if status != 'active':
                self.send_alert(f"Service {service} is DOWN! Attempting restart...")
                subprocess.run(['sudo', 'systemctl', 'restart', service])

    def watchdog_laravel_logs(self):
        if not os.path.exists(CONFIG['log_path']):
            return

        current_size = os.path.getsize(CONFIG['log_path'])
        if current_size > self.last_log_size:
            with open(CONFIG['log_path'], 'r') as f:
                f.seek(self.last_log_size)
                new_lines = f.readlines()
                for line in new_lines:
                    if 'CRITICAL' in line or 'FATAL' in line:
                        self.send_alert(f"Critical error found in Laravel logs: {line.strip()}")
            self.last_log_size = current_size

    def run(self):
        logging.info("Masons Monitoring Service Started.")
        while True:
            try:
                self.check_system_stats()
                self.check_services()
                self.watchdog_laravel_logs()
            except Exception as e:
                logging.error(f"Monitor loop error: {str(e)}")
            
            time.sleep(CONFIG['check_interval'])

if __name__ == "__main__":
    monitor = MasonsMonitor()
    monitor.run()
