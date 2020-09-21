#!/bin/sh
# 启动的时候生成 flag
echo "flag{b9a5839ba3c12b57961f53c3cf917e7e}" > /flag
# webshell 下看不到 flag 内容
chmod 600 /flag
# 想要看 flag 内容, 通过执行命令 tac /flag 来完成
chmod +s /usr/bin/tac

/etc/init.d/apache2 restart
/usr/bin/tail -f /dev/null