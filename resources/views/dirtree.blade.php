<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <script src="{{asset('js/jquery.min.js')}}"></script>

        <script type="text/javascript" language="javascript">
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
    function deletefolder(id) {

            $.ajax({
               type:'POST',
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
               url:'/deleteFolder',
               data: {id:id},
               success:function(data) {
                alert("Folder has been deactivated.");
                location.reload();
               }
            }); 
         }


         function deletefile(id) {
            
            $.ajax({
               type:'POST',
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
               url:'/deleteFiles',
               data: {id:id},
               success:function(data) {
                  alert("File has been deactivated.");
                  location.reload();

               }
            }); 
         }
         
    
        </script>
    </body>
</html>
