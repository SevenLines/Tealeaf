if [ -e tealeaf_remote.zip ]
then
    rm tealeaf_remote.zip
fi
zip -r  tealeaf_remote.zip . -x *.zip *.sh *.git* *.settings* nbproject\* *config/database* process\*