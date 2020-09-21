export RANGES_HOME=~/VulnRange/Ranges/	#设置靶机题库家目录,临时的只在这一个bash中有用
echo 1 > /proc/sys/net/ipv4/ip_forward && source /proc/sys/net/ipv4/ip_forward	#开启IP转发，否则无法访问题目容器的端口
export FLASK_APP=flaskr			#设置运行环境
export FLASK_ENV=development	#开启debug模式，有错误可以调试一下
flask run --host=0.0.0.0 		#运行项目，绑定0.0.0.0可外网访问

