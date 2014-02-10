if [ -e tealeaf.zip ]
then
    rm tealeaf.zip
fi
zip -r tealeaf.zip . -x *.zip *.sh *.git* *.settings* nbproject\* process\* dump.sql mmailmm8_data.sql