if [ -e tealeaf_remote_sml.zip ]
then
    rm tealeaf_remote_sml.zip
fi
zip -r  tealeaf_remote_sml.zip . -x *.zip *.sh *.git* *.settings* nbproject\* *config/database* www/files\* process\* dump.sql mmailmm8_data.sql