#!/bin/bash

# Masons Weekly Maintenance Script

LOG_FILE="/var/log/masons_maintenance.log"
echo "--- Starting Maintenance $(date) ---" >> $LOG_FILE

# 1. Clear Laravel Cache
cd /var/www/html
php artisan cache:clear >> $LOG_FILE
php artisan view:clear >> $LOG_FILE

# 2. Optimize Database (MySQL)
# mysqlcheck -o -u masons_user -p'masons_pass' masons_db >> $LOG_FILE

# 3. Rotate and Clear Logs older than 30 days
find /var/www/html/storage/logs/ -name "*.log" -mtime +30 -exec rm {} \;

# 4. Clean temp files
rm -rf /tmp/*

echo "--- Maintenance Completed $(date) ---" >> $LOG_FILE
