@extends('front.layouts.app')
<style>.team-card {
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.team-card img {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    height: 350px;
    object-fit: cover;
}
</style>
@section('content')

@endsection
