import requests
import time
import logging
from datetime import datetime

# Configuration
MONITOR_URLS = [
    {"name": "Backend API", "url": "http://localhost:8000/api/health"},
    {"name": "Frontend", "url": "http://localhost:3000"}
]
CHECK_INTERVAL = 60  # seconds

# Logging setup
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    filename='reliability.log'
)

def check_health():
    for site in MONITOR_URLS:
        try:
            start_time = time.time()
            response = requests.get(site["url"], timeout=10)
            latency = time.time() - start_time
            
            if response.status_code == 200:
                logging.info(f"SUCCESS: {site['name']} is healthy. Latency: {latency:.2f}s")
            else:
                logging.warning(f"ALERT: {site['name']} returned status {response.status_code}")
                # Here you would trigger an alert (e.g., Slack, Email)
                
        except requests.exceptions.RequestException as e:
            logging.error(f"CRITICAL: {site['name']} is UNREACHABLE. Error: {str(e)}")

if __name__ == "__main__":
    print(f"Starting Masons Reliability Tool at {datetime.now()}")
    print(f"Monitoring: {[s['name'] for s in MONITOR_URLS]}")
    
    try:
        while True:
            check_health()
            time.sleep(CHECK_INTERVAL)
    except KeyboardInterrupt:
        print("Monitoring stopped by user.")
