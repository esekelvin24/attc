<div class="col-md-12">
    <br>

 <div class="box box-info">
<div class="box-header with-border">
  <h3 class="box-title">Role Details</h3>
  </div>     
<div class="box-body">

<div class="row">
          
 <!-- /.box-header -->
<div class="col-md-12">
        <table id="tblmarketerinfo" class="table table-bordered"> 
                                 
                                    <tbody>
                                        <tr class="even pointer">
                                            <th scope="row" bgcolor="#F5F7FA">Name:</th>
                                            <td class="pull-xs-left col-sm-9 col-xs-8">{{$role_collection[0]->name}}</td>
                                        </tr>
                                    </tbody>

                                    <tbody>
                                        <tr class="even pointer">
                                            <th scope="row" bgcolor="#F5F7FA">Slug</th>
                                            <td class="pull-xs-left col-sm-9 col-xs-8">{{$role_collection[0]->slug}}</td>
                                        </tr>
                                    </tbody>

                                    <tbody>
                                        <tr class="even pointer">
                                            <th scope="row" bgcolor="#F5F7FA">Description:</th>
                                            <td class="pull-xs-left col-sm-9 col-xs-8">{{$role_collection[0]->description}}</td>
                                        </tr>
                                    </tbody>
                                <tbody>
                                    <tr class="even pointer">
                                        <th scope="row" bgcolor="#F5F7FA">Permissions:</th>
                                        <td class="pull-xs-left col-sm-9 col-xs-8">
                                        @foreach($role_permission_collection as $val)
                                            <label class="badge badge-warning">{{$val->name}}</label>
                                         @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                               

                                   
</table>
 
 </div></div></div></div></div>