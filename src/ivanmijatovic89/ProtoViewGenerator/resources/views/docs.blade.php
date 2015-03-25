@extends('protomaker::master')

@section('content')
   <h1>Documentation</h1>

   <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
       <ul class="nav">
           <li class="active"><a href="#">Home</a></li>
           <li><a href="#">Link 1</a></li>
           <li><a href="#">Link 2</a></li>
           <li><a href="#">Link 3</a></li>
       </ul>
   </div>
   <div class="col-xs-12 col-sm-9">
       <h1>Quick review for now</h1>
       <p>Name of Modul/Model allways set to singular, example : phone, book, car</p>

       <p>Validation write with pipes, example require|email|min:8</p>

       <p>When you choose relation <b>hasOne</b> for field set field + _id, example phone_id, book_id, car_id</p>

       <p>When you choose relation <b>belongsToMany</b> for field set fields  example phones, books, cars</p>

       <p>Relation field is filed that you wanna present in admin panel, for example if you wanna make relation for User (hasOne) to display email,
           you will choose :<br>
           field: user_id<br>
           type: relation <br>
           validation: yes<br>
           rules: required<br>
           relation: hasOne<br>
           model namespace : \App\Models\User - or your namespace of User class<br>
           relation filed: <b>email</b> - or any other filed from user table<br>
           relation name : users - how do you wanna call this relation in your model<br>

       </p>


   </div><!-- /.col-xs-12 main -->
@stop