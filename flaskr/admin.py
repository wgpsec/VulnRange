from flask import (
    Blueprint, flash, g, redirect, render_template, request, url_for,jsonify
)
from werkzeug.exceptions import abort
from flaskr.db import get_db


bp = Blueprint('admin', __name__,url_prefix='/admin')


@bp.route('/')
def index():
    db = get_db()
    return render_template('admin/admin.html')

@bp.route('/welcome')
def welcome():
    db=get_db()
    q_total = db.execute('SELECT count(id) FROM questions ')  # 靶机总数
    return render_template('admin/welcome.html',q_total=q_total)

#题目列表
@bp.route('/questions-list',methods=('GET', 'POST'))
def questions_list():
    db = get_db()
    p_cates = db.execute('SELECT fcate_name FROM p_cate')
    if request.method == 'POST':
        scate_name = request.form['scate_name']
        lists = db.execute('SELECT * FROM questions WHERE s_cate = ?'
                       ' ORDER BY id ASC', (scate_name,))
    else:
        lists = db.execute('SELECT * FROM questions '
                       ' ORDER BY id ASC')
    return render_template('admin/questions-list.html', lists=lists, p_cates=p_cates)

#下拉菜单二级联动请求接口
@bp.route('/second_action', methods=('GET', 'POST'))
def second_action():
    db=get_db()
    if request.method == 'POST':
        title = request.form['fcate_name']
    s_cates = db.execute('SELECT scate_name FROM s_cate WHERE p_cate = ?', (title,)).fetchall()
    list =[]
    for i in s_cates:
        t=i['scate_name']
        list.append(t)
    return jsonify(list)


#添加题目
@bp.route('/create-questions', methods=('GET', 'POST'))
def create_questions():
    db = get_db()
    p_cates = db.execute('SELECT fid, fcate_name FROM p_cate ORDER BY fid ASC')
    if request.method == 'POST':
        title = request.form['title']
        hint = request.form['hint']
        p_cate = request.form['p_cate']
        s_cate = request.form['s_cate']
        error = None

        if not title:
            error = '题目标题不能为空'

        if error is not None:
            flash(error)
        else:
            db = get_db()
            db.execute(
                'INSERT INTO questions (title,hint,p_cate,s_cate)'
                ' VALUES (?, ?, ?, ?)',
                (title, hint, p_cate, s_cate)
            )
            db.commit()

    return render_template('admin/create-questions.html', p_cates=p_cates)

def get_questions_list(id):
    post = get_db().execute(
        'SELECT * FROM questions'
        ' WHERE id = ?',(id,)
    ).fetchone()
    if post is None:
        abort(404, "Post id {0} doesn't exist.".format(id))
    return post
#修改题目
@bp.route('/<int:id>/questions-edit', methods=('GET', 'POST'))
def questions_edit(id):
    post = get_questions_list(id)
    db=get_db()
    p_cates = db.execute('SELECT fid, fcate_name FROM p_cate ORDER BY fid ASC')
    if request.method == 'POST':
        title = request.form['title']
        hint = request.form['hint']
        p_cate = request.form['p_cate']
        s_cate = request.form['s_cate']
        error = None

        if not title:
            error = '题目不能为空'

        if error is not None:
            flash(error)
        else:
            db = get_db()
            db.execute(
                'UPDATE questions SET title = ?, hint = ?, p_cate = ?, s_cate = ?'
                ' WHERE id = ?',
                (title, hint, p_cate,s_cate, id)
            )
            db.commit()

    return render_template('admin/questions-edit.html', post=post, p_cates=p_cates)

#删除题目
@bp.route('/<int:id>/questions-del', methods=('GET', 'POST'))
def questions_del(id):
    get_questions_list(id)
    db = get_db()
    db.execute('DELETE FROM questions WHERE id = ?', (id,))
    db.commit()

    return redirect(url_for('admin.questions_list'));

#题目分类列表
@bp.route('/cate-list')
def cate_list():
    db = get_db()
    lists = db.execute(
        'SELECT * FROM p_cate INNER JOIN s_cate sc on p_cate.fcate_name = sc.p_cate')
    p_cates = db.execute('SELECT DISTINCT fcate_name,fid FROM p_cate')
    return render_template('admin/cate.html', lists=lists,p_cates=p_cates)

#添加题目父分类
@bp.route('/create-cate', methods=('GET', 'POST'))
def create_cate():
    if request.method == 'POST':
        p_cate = request.form['p_cate']
        error = None

        if not p_cate:
            error = '分类名不能为空'

        if error is not None:
            flash(error)
        else:
            db = get_db()
            db.execute(
                'INSERT INTO p_cate (fcate_name)'
                ' VALUES (?)',(p_cate,)
            )
            db.commit()

    return render_template('admin/create-cate.html')

def get_p_cate_list(id):
    post = get_db().execute(
        'SELECT fid,fcate_name FROM p_cate'
        ' WHERE fid = ?',(id,)
    ).fetchone()
    if post is None:
        abort(404, "Post id {0} doesn't exist.".format(id))
    return post
#删除题目父分类
@bp.route('/<int:id>/p_cate-del', methods=('GET',))
def p_cate_del(id):
    post = get_p_cate_list(id)
    db = get_db()
    db.execute('DELETE FROM p_cate WHERE fid = ?', (id,))
    db.commit()

    return redirect(url_for('admin.cate_list'));
#修改题目父分类
@bp.route('/<int:id>/p_cate-edit', methods=('GET', 'POST'))
def p_cate_edit(id):
    post = get_p_cate_list(id)
    if request.method == 'POST':
        p_cate = request.form['p_cate']
        error = None
        if not p_cate:
            error = '父分类名不能为空'
        if error is not None:
            flash(error)
        else:
            db = get_db()
            db.execute(
                'UPDATE p_cate SET fcate_name = ?'
                ' WHERE fid = ?',(p_cate,id)
            )
            db.commit()
    return render_template('admin/p_cate-edit.html', post=post)

#添加题目子分类
@bp.route('/<int:id>/create-s_cate', methods=('GET', 'POST'))
def create_s_cate(id):
    post = get_p_cate_list(id)
    if request.method == 'POST':
        s_cate = request.form['s_cate']
        error = None

        if not s_cate:
            error = '分类名不能为空'

        if error is not None:
            flash(error)
        else:
            db = get_db()
            db.execute(
                'INSERT INTO s_cate (scate_name,p_cate)'
                ' VALUES (?,?)',(s_cate,post['fcate_name'])
            )
            db.commit()

    return render_template('admin/create-s-cate.html',post=post)

def get_s_cate_list(id):
    post = get_db().execute(
        'SELECT * FROM s_cate'
        ' WHERE sid = ?',(id,)
    ).fetchone()
    if post is None:
        abort(404, "Post id {0} doesn't exist.".format(id))
    return post
#删除题目子分类
@bp.route('/<int:id>/s_cate-del', methods=('GET',))
def s_cate_del(id):
    get_s_cate_list(id)
    db = get_db()
    db.execute('DELETE FROM s_cate WHERE sid = ?', (id,))
    db.commit()

    return redirect(url_for('admin.cate_list'));

#修改题目父分类
@bp.route('/<int:id>/s_cate-edit', methods=('GET', 'POST'))
def s_cate_edit(id):
    post = get_s_cate_list(id)
    if request.method == 'POST':
        s_cate = request.form['s_cate']
        error = None
        if not s_cate:
            error = '分类名不能为空'
        if error is not None:
            flash(error)
        else:
            db = get_db()
            db.execute(
                'UPDATE s_cate SET scate_name = ?'
                ' WHERE sid = ?',(s_cate,id)
            )
            db.commit()
    return render_template('admin/s_cate-edit.html', post=post)