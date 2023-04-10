@extends('master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Delete Position</div>

                <div class="card-body">
                    <p>Are you sure you want to delete this position?</p>

                    <form action="{{ route('positions.destroy', $position->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection