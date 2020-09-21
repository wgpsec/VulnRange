#!/bin/sh
# 启动的时候生成 flag
echo "flag{bf1df6da19c1c10e1cbdca1f88d1598e}" > /flag
# webshell 下看不到 flag 内容
chmod 600 /flag
# 想要看 flag 内容, 通过执行命令 tac /flag 来完成
chmod +s /usr/bin/tac

php-fpm
