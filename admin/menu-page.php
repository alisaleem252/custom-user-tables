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
                             	<?php echo WPUserRolesDropdown()?>
                            </select> 
                         </div>
                     </div>      
               </div>
               
                        
                <table class="table">
                  <thead>
                    <tr>
                          <th scope="col"><?php _e('UID',MASTEXTDOMAIN)?></th>
                          <th scope="col" style="cursor:pointer;" ng-click="updateusers()" ng-model="orderby"><?php _e('Username',MASTEXTDOMAIN)?> <span class="dashicons dashicons-sort"></span></th>
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