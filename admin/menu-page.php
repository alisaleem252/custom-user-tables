<div class="wpwrap" ng-app="CustomUsersTable" ng-controller="MyOptions">
	<h1><?php _e('Users Table',MASTEXTDOMAIN)?></h1>			
	<div class="wpcontainer" >
		<div class="row">	
			<div class="container">
            	<div class="col-md-6 float-right">
                    <div class="row">
                        <div class="col-md-4 offset-md-8">
                            <select class="custom-select form-control" ng-change="updateusers()" ng-model="filter">
                            	<option value=""><?php _e('Filter by Role',MASTEXTDOMAIN)?></option>
                             	<?php echo mamcut_users_role_select_options()?>
                            </select> 
                         </div>
                     </div>      
               </div>
               
                        
                <table class="table">
                  <thead>
                    <tr>
                          <th scope="col"><?php _e('UID',MASTEXTDOMAIN)?></th>
                          <th scope="col" style="cursor:pointer;" ng-click="updateusers()" ng-model="orderby"><?php _e('Username',MASTEXTDOMAIN)?> <svg style="width:7px" aria-hidden="true" data-prefix="fas" data-icon="arrows-alt-v" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-arrows-alt-v fa-w-8"><path fill="currentColor" d="M214.059 377.941H168V134.059h46.059c21.382 0 32.09-25.851 16.971-40.971L144.971 7.029c-9.373-9.373-24.568-9.373-33.941 0L24.971 93.088c-15.119 15.119-4.411 40.971 16.971 40.971H88v243.882H41.941c-21.382 0-32.09 25.851-16.971 40.971l86.059 86.059c9.373 9.373 24.568 9.373 33.941 0l86.059-86.059c15.12-15.119 4.412-40.971-16.97-40.971z" class=""></path></svg></th>
                          <th scope="col"><?php _e('Role',MASTEXTDOMAIN)?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="user in users">
                          <th scope="row">{{user.data.ID}}</th>
                          <td>{{user.data.user_login}}</td>
                          <td>{{user.roles[0]}}</td>
                    </tr>
                  </tbody>
                </table>

                
               
                
                <nav aria-label="...">
                  <ul class="pagination">
                    <li class="page-item {{currentpage == 1 ? 'disabled' : ''}}">
                      <a class="page-link" href="" tabindex="-1" ng-click="currentpage = currentpage - 1 ; updateusers()"><?php _e('Previous',MASTEXTDOMAIN)?></a>
                    </li>
                    	<li ng-repeat="pagination in paginations" class="page-item {{currentpage == pagination.key ? 'active' : ''}}">
							<a ng-click="updateusers(pagination.key)" class="page-link" href="">{{pagination.key}}</a>
					  </li>
                    <li class="page-item {{currentpage == totalpages ? 'disabled' : ''}}">
                      <a class="page-link" href="" ng-click="currentpage = currentpage+1;updateusers()"><?php _e('Next',MASTEXTDOMAIN)?></a>
                    </li>
                  </ul>           
                 <p>Viewing Page {{currentpage}} of {{totalpages}}</p>
                </nav>
				<div class="clear"></div>
                
			</div><!-- Container -->
		</div><!-- row -->  
	</div><!-- wpcontainer-->			
</div><!--  ng-app="CustomUsersTable" ng-controller="MyOptions" -->