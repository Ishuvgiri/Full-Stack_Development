@extends('layout')
@section('title','Edit Employee')
@section('content')
<form method="post" action="index.php?action=update">
<input type="hidden" name="id" value="{{ $employee['id'] }}">
<input name="name" placeholder="Name" value="{{ $employee['name'] }}" required><br><br>
<input name="title" placeholder="Job Title" value="{{ $employee['title'] }}" required><br><br>
<input name="skills" placeholder="Skills (comma separated)" value="{{ $employee['skills'] }}" required><br><br>
<button>Update</button>
</form>
@endsection