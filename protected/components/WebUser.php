<?php 
class WebUser extends CWebUser
{
    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params=array())
    {
        if (empty($this->emp_id)) {
            // Not identified => no rights
            return false;
        }

        $acl = $this->convertMyRoleForYii();
        
        
			        
        if ($acl === 'admin') {
            return true; // admin role has access to everything
        }

        // allow access if the operation request is the current user's role
        return ($operation === $acl);
    }
    
    private function convertMyRoleForYii(){
		$acl = 'guest';    	
    	switch(Yii::app()->user->getState('access_lvl_id')){
    		case HrisAccessLvl::$ADMINISTRATOR: $acl = 'admin'; break;
    		case HrisAccessLvl::$HR : $acl = 'hr'; break;
    		case HrisAccessLvl::$SUPERVISOR: $acl = 'sup'; break;
        case HrisAccessLvl::$MANAGER: $acl = 'mgr'; break;
    		case HrisAccessLvl::$EMPLOYEE: $acl = 'emp'; break;
        case HrisAccessLvl::$EMPLOYER : $acl = 'employer'; break; 
    		default: $acl = 'guest';
		}
		return $acl;
	}
    
}