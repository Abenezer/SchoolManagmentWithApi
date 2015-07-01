/**
 * Created by Lidya on 6/30/2015.
 */
var login = angular.module('loginModule',['ui.validate','ui.bootstrap']);

login.controller('loginCtrl',function($scope,$http,$window){



    function recheck()
    {
        $http.get('api/login').success(function(data){


            if(data.loggedIn){

                var url = "http://" + $window.location.host + "/web";

                $window.location.href = url;
            }
        });
    }


    recheck();


   $scope.login = function(user)
   {
       $http.post('api/login',user).success(function(){
           recheck();

       })
   }

})


login.controller('studentRegistrationCtrl',function($scope,$http,$window){


    $scope.studentForm= "web/views/studentRegistration.html";
    $scope.add_student = function(Student) {

        $http.post('api/student', Student).success(function(){
            var user = {};
            user.username = Student.username;
            user.password = Student.password;
            $http.post('api/login',user).success(function(){
                recheck();

            })


        });
        $scope.reset = function() {
            $scope.Student = {};
        };
        //$scope.reset();
    };


    function recheck()
    {
        $http.get('api/login').success(function(data){


            if(data.loggedIn){

                var url = "http://" + $window.location.host + "/web";

                $window.location.href = url;
            }
        });
    }

})