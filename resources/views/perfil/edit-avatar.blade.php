 <!-- Modal Structure -->
  <div id="modal_edit_image_avatar" class="modal">
    <form method="POST" enctype='multipart/form-data' action="{{url('profile',[$usuario->getIdUsuario()])}}">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
        <div class="modal-content">
        <h4>Cambiar imagen de avatar</h4>
        <h6>Asegurate de que la imagen sea de 150x150 pixeles para que se coloque correctamente como portada.</h6>
        <hr>
            <p>&nbsp;</p>     
        <input type="hidden" name="ecAction" value="edit-avatar"> 
        <img id="imagen-avatar-vista-previa" src="{{url('/image/profile/avatar?id='.$usuario->getIdUsuario())}}" class="ec-img-avatar ec-img-avatar-modal" style="">
        <output id='list-avatar'></output>
        <div class="file-field input-field">
            <div class="btn row orange waves-effect waves-light">
                <input name="imgAvatar" id='img-avatar' type="file" class="col s12 l12" accept="image/*">
                <span class="material-icons" style="line-height:42px;">mode_edit</span>
            </div>
        </div>

        <div class="modal-footer">
        <button class="btn waves-effect waves-light orange" type="submit" name="action">Guardar
            <i class="material-icons right">send</i>
        </button> 
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
    </form>
  </div>
  <script>
    $(document).ready(function(){
    $('.modal').modal();
     
  });
  </script>
  <script>		
  function imagen_avatar(evt) 
    {
        var files = evt.target.files; // FileList object
        var objectType = 0;
        //Obtenemos la imagen del campo "file". 
        for (var i = 0, f; f = files[i]; i++) 
        {         
            ////Solo admitimos imágenes.
            //if ((!f.type.match('image.*')) || (!f.type.match('video.*')))// || !f.type.match('video.*'))
            //{
            //continue;
            //}
                if(f.type.match('image.*'))
                {
                    objectType = 1;
                }
                if(f.type.match('video.*'))
                {
                    objectType = 2;
                }
            
                var reader = new FileReader();
                reader.onload = (function(theFile) 
                {
                    return function(e) 
                    {
                        // Creamos la imagen.
                        document.getElementById('imagen-avatar-vista-previa').style.display = 'none';
                        
                        if(objectType == 1)
                            document.getElementById("list-avatar").innerHTML = ['<img class="ec-img-avatar ec-img-avatar-modal" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');    
                        
                        if(objectType==2)
                            document.getElementById("list-avatar").innerHTML = ['<video controls width="100%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');    

                        //setEvent();
                    };
            })(f);
            reader.readAsDataURL(f);
            
        }
    }
    
    document.getElementById('img-avatar').addEventListener('change', imagen_avatar, false);
					
</script>