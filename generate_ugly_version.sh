#!/bin/bash

# This script generate an Ugly version of Cerbo by removing all
# namespaces from files...
# It is needed for servers with PHP older than 5.3

clear
echo -e "\e[1mCerbo \e[94mMAKING UGLY\e[0m"
echo 

# Init some variable ################################################
UGLY_FOLDER="__UGLY__"

# Try to access the ugly version folder #############################
if [ -d "$UGLY_FOLDER" ] ; then
    # Remove previous existing version
    rm -Rf $UGLY_FOLDER
fi

# Create the folder #################################################
mkdir $UGLY_FOLDER

# Copy all the data to the UGLY FOLDER ##############################

echo -e "\e[4mCopying files\e[0m"
echo

echo -e " Copying \e[32mextensions\e[0m..."
cp -R extensions $UGLY_FOLDER
echo -e "   \e[90mdone\e[0m"

echo -e " Copying \e[32mkernel\e[0m..."
cp -R kernel $UGLY_FOLDER
echo -e "   \e[90mdone\e[0m"

echo -e " Copying \e[32mlib\e[0m..."
cp -R lib $UGLY_FOLDER
echo -e "   \e[90mdone\e[0m"

echo -e " Copying \e[32msettings\e[0m..."
cp -R settings $UGLY_FOLDER
echo -e "   \e[90mdone\e[0m"

echo -e " Copying \e[32mvar\e[0m..."
cp -R var $UGLY_FOLDER
echo -e "   \e[90mdone\e[0m"

echo -e " Copying \e[32mautoload.php\e[0m..."
cp autoload.php $UGLY_FOLDER
echo -e "   \e[90mdone\e[0m"

echo -e " Copying \e[32mindex.php\e[0m..."
cp index.php $UGLY_FOLDER
echo -e "   \e[90mdone\e[0m"

echo 

# Modify files ######################################################
echo -e "\e[4mRemoving namespaces from files\e[0m"

echo 

echo -e " Removing namespace \e[32mcerbo::kernel\e[0m from files..."
for file in `find $UGLY_FOLDER -type f`; do
    sed 's/cerbo//g' $file > $file
done
echo -e "   \e[90mdone\e[0m"

# END ###############################################################
echo 
echo -e "Your \e[35mugly\e[0m version of \e[1mCerbo\e[0m has been placed in \e[95m$UGLY_FOLDER\e[0m."
echo
