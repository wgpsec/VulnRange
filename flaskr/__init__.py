#coding=utf-8
import os
from flask import Flask
from .import db
from .import admin
from .import index

def create_app(test_config=None):
    # create and configure the app
    app = Flask(__name__, instance_relative_config=True)
    db.init_app(app)#初始化数据库设置

    #注册蓝图
    app.register_blueprint(admin.bp)
    app.register_blueprint(index.bp)

    #设置根目录路由
    app.add_url_rule('/',endpoint='index.index')


    app.config.from_mapping(
        SECRET_KEY='dev',
        DATABASE=os.path.join(app.instance_path, 'flaskr.sqlite'),
    )

    if test_config is None:
        # load the instance config, if it exists, when not testing
        app.config.from_pyfile('config.py', silent=True)
    else:
        # load the test config if passed in
        app.config.from_mapping(test_config)

    # ensure the instance folder exists
    try:
        os.makedirs(app.instance_path)
    except OSError:
        pass

    return app