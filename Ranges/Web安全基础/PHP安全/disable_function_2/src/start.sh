#!/bin/sh
# 启动的时候生成 flag
echo "flag{aedff67978a42d31d9a5c483a36f1518}" > /flag
# webshell 下看不到 flag 内容
chmod 600 /flag
# 想要看 flag 内容, 通过执行命令 tac /flag 来完成
chmod +s /usr/bin/tac

/etc/init.d/apache2 restart
/usr/bin/tail -f /dev/null