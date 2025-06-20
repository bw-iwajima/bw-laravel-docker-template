# Laravel Lesson レビュー①

## Todo一覧機能

### Todoモデルのallメソッドで実行しているSQLは何か
-select * from todos
### Todoモデルのallメソッドの返り値は何か
-todosテーブルから全レコードを取得したコレクション

### 配列の代わりにCollectionクラスを使用するメリットは
-データを操作するメソッドが豊富に用意されており、可読性と保守性が配列に比べて高い。
-またメソッドチェーンを用いて複数の処理を簡潔に記述できる。

### view関数の第1・第2引数の指定と何をしているか
-第1引数:todo.index
--ビューに表示させたいhtmlを記述しているindex.blade.phpを指定。
--resources/views/todo/index.blade.phpにあるためtodo.indexで指定できる。

-第2引数:'todos'=>$todos
--ビューindex.blade.phpに対して'todos'という名前で$todosを渡している。
--渡す際はキー'todos',値$todosの連想配列
--ビュー内では'todos'は$todosという変数名で渡した値にアクセスすることができる。

### index.blade.phpの$todos・$todoに代入されているものは何か
-$todos:TodoControllerのindexメソッドで渡されたTodosテーブルから全レコードを取得したコレクション
-$todo:foreachで$todosから取り出した単一のレコードのオブジェクト

## Todo作成機能

### Requestクラスのallメソッドは何をしているか
-フォームからpostされたすべての情報を連想配列で取得している。

### fillメソッドは何をしているか
-連想配列で取得した複数の属性の値をTodoモデルのインスタンスのプロパティに一括で代入している。

### $fillableは何のために設定しているか
-fillメソッドで代入できる属性の許可の設定をすることで
-意図しないカラム、編集されたら困るカラムは入力されないようになり、
-一括代入で発生する脆弱性に対応するため。

### saveメソッドで実行しているSQLは何か
-insert into todos (content) values (入力した値)
### redirect()->route()は何をしているか
-todo.indexに対応するURLの/todoにリダイレクト。/todoにアクセスしたらTodoControllerのindexメソッドが実行される。
-index.blade.phpに記述されたTodo一覧表示のhtmlが表示される。
## その他

### テーブル構成をマイグレーションファイルで管理するメリット
-SQLを知らなくてもPHPコードでテーブル操作ができ学習コストが不要。
-マイグレーションファイルをgitで共有することで開発者全員が同じテーブルを作成することができる。

### マイグレーションファイルのup()、down()は何のコマンドを実行した時に呼び出されるのか
--up()を呼び出すにはphp artisan migrate
-down()を呼び出すにはphp artisan migrate:rollback

### Seederクラスの役割は何か
-作成したテーブルにテストデータを登録する。
-テストデータ登録の前にテーブルのレコードを全削除のsqlも記載されているので、
-開発者間のテストデータに差異が出ないようにしている。

### route関数の引数・返り値・使用するメリット
-引数は名前付きルート
-返り値は名前付きルートに対応するURL
-メリット：URLの記述が簡潔になり可読性が向上、
-urlを変更する場合ルート名の変更がなければ修正箇所は名前付きルートを設定しているweb.php一つで済むので保守性も向上する。

### @extends・@section・@yieldの関係性とbladeを分割するメリット
-@extends('layouts.base')で継承元の親Bladeを指定することで。親Bladeのテンプレートを継承できる。
-継承先の子Bladeで新しく表示させたいものを@section('content') ~ @endsection内に記述する。
-@yield('content')に@section('content') ~ @endsectionの中の記述が差し込まれて表示できるようになる。
-@yield('content')の記述がないと子bladeで追記した内容は表示されない。
-bladeを分割するメリットは保守性と再利用性の向上。
-共通部分を持った親bladeと子bladeに分けることができるため、修正箇所がでてもすべてのbladeを修正する必要がなくなる。

### @csrfは何のための記述か
-CSRF攻撃の対策
-正規のフォームからリクエストされたものかを判断するために自動でトークンを生成してフォーム送信の際に一緒に送信できるようにするための記述。
-送信されたトークンの判定はlaravelが自動的に行ってくれる。
### {{ }}とは何の省略系か
-<?php echo e(); ?>