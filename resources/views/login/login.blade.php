<!DOCTYPE html>
<html lang="en">
@include("head.head")
<body>
  <div class="container">
        <h3 class="text-center my-4">
          <i class="fa fa-tooth"></i>
          Laboratorio Fernando Pinto
        </h3>
        <hr class="col-10"/>
    <div class="col-lg-4 col-md-4 col-xs-4 offset-lg-4 offset-md-4 offset-xs-4">
      <div class="card card-default">
        <div class="card-header text-center">
              Entrar al laboratorio
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
            <div class="form-group">
              <label for="USERNAME">Usuario</label>
              <div class="input-group">
                <input type="text" name="USERNAME" id="USERNAME" class="form-control {{ $errors->has('USERNAME') ? 'is-invalid' : '' }}" placeholder="Ingresa el usuario:" value="{{old('USERNAME')}}">
                <i class="fa fa-user"></i>
              </div>
              {!! $errors->first('USERNAME', '<span class="form-text text-danger">:message</span>') !!}
            </div>
            <div class="form-group">
              <label for="PASSWORD">Contraseña</label>
              <div class="input-group">
                <input type="password" name="PASSWORD" id="PASSWORD" class="form-control {{ $errors->has('PASSWORD') ? 'is-invalid' : '' }}" placeholder="Ingresa la contraseña:" value="">
                <i class="fa fa-lock"></i>
              </div>
              {!! $errors->first('PASSWORD', '<span class="form-text text-danger">:message</span>') !!}
            </div>
            <div class="form-group">
              <button class="btn btn-block btn-danger">Acceder</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>