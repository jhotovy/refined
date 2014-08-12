#!/bin/bash
export PATH=$PATH:~/tools/node/bin:~/www/refinethemind/wp-content/themes/refined/node_modules/grunt-cli/bin

RUNNING=`pgrep grunt`
if [ -z "$RUNNING" ] ; then
    echo "grunt is not running; restarting"
    grunt watch &
else
    echo "grunt is running"
fi
