<style>
body
{
    background: url({{URL::asset('img/login.png')}}) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    color:white;
}
#msg
{
    text-align:center;
}
label
{
    color:white;
}
.col-lg-5
{
    margin:20px 29%;

    text-align: center;
}
.login
{
    margin-top: 250px;
}

@media(max-width: 480px) {

}
</style>
{{HTML::style('css/bootstrap.min.css')}}
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
{{HTML::script('js/common.js')}}
<div id = 'msg'></div>
<div class = 'container login'>
    <form method="POST" action="{{{ URL::to('/users/login') }}}" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
        <div class = 'col-lg-5'>
            <label for="email">{{{ Lang::get('confide::confide.username_e_mail') }}}</label><br />
            <input class="form-control" tabindex="1" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
        </div>
        <div class = 'col-lg-5'>
            <label for="password">
                {{{ Lang::get('confide::confide.password') }}}
            </label><br />
            <input class="form-control" tabindex="2" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password"><br />
            <a href="{{{ URL::to('/users/forgot_password') }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
        </div>
            @if (Session::get('error'))
            <script>
                var data = "<div class='alert alert-error alert-danger'>{{{ Session::get('error') }}}</div>";
                $('#msg').html(data);
            </script>
            @endif
            @if (Session::get('notice'))
            <script>
                var data = "<div class='alert'>{{{ Session::get('notice') }}}</div>";
                $('#msg').html(data);
            </script>
            @endif
        <div class = 'col-lg-5'>
            <button tabindex="3" type="submit" class="btn btn-success">{{{ Lang::get('confide::confide.login.submit') }}}</button>
        </div>
    </form>
</div>
