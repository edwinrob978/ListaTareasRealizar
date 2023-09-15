 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="" class="brand-link">
        
         <span class="brand-text font-weight-light"></span> <span
             class="brand-text font-weight-light"> Lista de tareas</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                 data-accordion="false">

                 <li class="nav-item">
                     <a style="cursor: pointer;" class="nav-link active"
                     onclick="CargarContenido('vistas/tareas.php', 'content-wrapper')">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             Tareas 
                         </p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>

 <script>

$(".nav-link").on('click', function() {
    $(".nav-link").removeClass('active');
    $(this).addClass('active');
})
</script>