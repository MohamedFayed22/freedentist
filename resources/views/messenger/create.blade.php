@extends('frontend.app')

@section('content')
<main class="main-content">
      <!--upcomingDates section-->
      <section class="register">
        <div class="title">
          <div class="container">
             <h1>@lang('mesg.create')</h1>
          </div>
        </div>
        <div class="container">
          <div class="content">
   
    <form action="{{ route('messages.store') }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-6">
            <!-- Subject Form Input -->
            <div class="form-group">
                <label class="control-label">@lang('mesg.subject')</label>
                <input type="text" class="form-control" name="subject" placeholder="Subject"
                       value="{{ old('subject') }}" required>
            </div>

            <!-- Message Form Input -->
            <div class="form-group">
                <label class="control-label">@lang('mesg.message')</label>
                <textarea name="message" class="form-control" required></textarea>
            </div>

            @if($users->count() > 0)
                <div class="checkbox" >
                    @foreach($users as $user)
                        <label title="{{ $user->name }}"><input  type="checkbox" name="recipients[]"
                                                                value="{{ $user->id }}">{!!$user->name!!}</label>
                    @endforeach
                </div>
            @endif
    
            <!-- Submit Form Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">@lang('mesg.submit')</button>
            </div>
        </div>
    </form>
    </div>   </div>   </div>
@stop
