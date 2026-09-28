@extends("layouts.default")

@section("header")
<p class="eyebrow">FIRST WEBSITE</p>
<h1>This is a contact page!</h1>
<a class="test-link" href="{{ route('testpage') }}">Go to test page</a>
@endsection


@section("maincontent")
<a href="#">Email</a>
@endsection

@section("footer")
<h1>This is a footer!</h1>
@endsection