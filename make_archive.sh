find . -path '*/.*' -prune -o -type f -print | zip content.zip -@ -x application/config/database.php