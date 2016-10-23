@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>警告!</strong> 数据录入不合法.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
