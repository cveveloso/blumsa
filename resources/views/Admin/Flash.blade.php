<div class="modal fade" id="messageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="container">
                    {{ Session::get('message') }}
                    @php
                    $errors = Session::get('error');
                    $messages = Session::get('success');
                    $info = Session::get('info');
                    $warnings = Session::get('warning');
                    @endphp
                    @if ($errors) @foreach($errors as $key => $value)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Error!</strong> {{ $value }}
                        </div>

                    @endforeach 
                    <script>
                        $("#messageModal").modal();
                        $("#messageModal").modal("hide");
                    </script>
                    @endif
                    
                    @if ($messages) @foreach($messages as $key => $value)
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>Success!</strong> {{ $value }}
                        </div>
                    @endforeach 
                    <script>$("#messageModal").modal();</script>                    
                    @endif
                    
                    @if ($info) @foreach($info as $key => $value)
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <strong>Info!</strong> {{ $value }}
                        </div>
                    @endforeach 
                    <script>$("#messageModal").modal();</script>                    
                    @endif
                    
                    @if ($warnings) @foreach($warnings as $key => $value)
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <strong>Warning!</strong> {{ $value }}
                        </div>
                    @endforeach 
                    <script>$("#messageModal").modal();</script>                    
                    @endif
            </div>

        </div>
      </div>
    </div>
</div>

