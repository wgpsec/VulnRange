from flask import (
    Blueprint, flash, g, redirect, render_template, request, url_for,jsonify
)
from werkzeug.exceptions import abort
from flaskr.db import get_db
import os
import socket

def get_ip():
    try:
        s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
        s.connect(('8.8.8.8', 80))
        ip = s.getsockname()[0]
    finally:
        s.close()
    return ip
def get_docker_port(cmd):
    result = os.popen(cmd)
    rs = result.read()
    port = str(rs)
    return port

bp = Blueprint('index', __name__,url_prefix='/index')

@bp.route('/')
def index():
    db = get_db()
    lists = db.execute('SELECT * FROM questions '
                       ' ORDER BY id ASC')
    p_cates = db.execute('SELECT DISTINCT fcate_name FROM p_cate ORDER BY fid ASC')
    return render_template('index/index.html', lists=lists,p_cates=p_cates)
#欢迎页面
@bp.route('/welcome')
def welcome():
    return render_template('index/welcome.html')

#靶机列表
@bp.route('/<string:p_cate>/questions-list', methods=('GET', 'POST'))
def questions_list(p_cate):
    db = get_db()
    if request.method == 'POST':
        s_cate = request.form['s_cate']
        lists = db.execute('SELECT * FROM questions WHERE p_cate = ? AND s_cate = ?'
                       ' ORDER BY id ASC',(p_cate,s_cate))
    else:
        lists = db.execute('SELECT * FROM questions WHERE p_cate = ?'
                       ' ORDER BY id ASC',(p_cate,))

    return render_template('index/questions-list.html', lists=lists, p_cate=p_cate)

def get_questions_list(qid):
    lists = get_db().execute('SELECT * FROM questions WHERE id=?',(qid,)).fetchone()
    if lists is None:
        abort(404, "Post id {0} doesn't exist.".format(qid))
    return lists

#靶机详细信息
@bp.route('/<int:qid>/range-info', methods=('GET', 'POST'))
def range_info(qid):
    lists = get_questions_list(qid)
    return render_template('index/range-info.html',lists=lists)

#题目容器操作接口
@bp.route('/<int:qid>/docker_action', methods=('GET','POST'))
def docker_action(qid):    #下拉菜单二级联动
    db=get_db()
    p_cate = db.execute('SELECT p_cate FROM questions WHERE id =?', (qid,)).fetchone()
    s_cate = db.execute('SELECT s_cate FROM questions WHERE id =?', (qid,)).fetchone()
    title = db.execute('SELECT title FROM questions WHERE id =?', (qid,)).fetchone()
    action = request.form['action']
    if action == 'start':
        os.system("cd $RANGES_HOME/{p}/{s}/{t}/ && docker-compose up -d".format(p=p_cate['p_cate'],s=s_cate['s_cate'],t=title['title']))
        IP=get_ip()
        cmd = "docker port {t} | ".format(t=title['title'])+"awk -F: '{print $2}'"
        PORT=get_docker_port(cmd)
        URL="http://"+IP+":"+PORT
        return URL      #返回靶机URL
    elif action == 'stop':
        os.system('docker rm -f %s' % title['title'])
        os.system('echo "y" | docker network prune')
        return "docker stoped!"
    else:
        return "some thing wrong! "+action