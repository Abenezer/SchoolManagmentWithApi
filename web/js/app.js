var app = angular.module('SRMSApp',['ngRoute','ui.validate','ui.bootstrap']).
    config(function($routeProvider) {
        $routeProvider.
            when('/', {templateUrl: 'views/home.html'}).
            when('/AddEmployee', {templateUrl: 'views/EmployeeRegistration.html',controller: registerEmpCrtl}).
            when('/CourseDetail', {templateUrl: 'views/CourseDetailForm.html',controller:courseDetailCtrl}).
            when('/EnrollStudent', {templateUrl: 'views/enrollment.html',controller:enrollmentController}).
            when('/EditStudent', {templateUrl: 'views/listStudents.html',controller:ListStudentCtrl,
                resolve: {isApproved: function () { return -1;  }   }
            }).
            when('/EditEmployee', {templateUrl: 'views/listEmployees.html',controller:ListEmpCtrl }).
            when('/StudentStatus', {templateUrl: 'views/studentStatus.html',controller:studentStatusCtrl}).
            when('/ApprovedStudents', {templateUrl: 'views/listStudents.html',controller:ListStudentCtrl,

                resolve: {
                    isApproved: function () {

                        return 1;
                    }
                }


            }).
            when('/PendingStudents', {templateUrl: 'views/listStudents.html',controller:ListStudentCtrl,

                resolve: {
                    isApproved: function () {

                        return 0;
                    }
                }


            }).
            when('/RegisterStudent', {templateUrl: 'views/studentRegistration.html',controller:registerStudentCrtl}).

            when('/about', {templateUrl: 'views/about.html'}).
            otherwise({redirectTo: '/'});
    })

    ;



app.factory('AppAlert', function($rootScope){
    $rootScope.alerts = [];
    var alertService = {};

    alertService.add = function(type,msg)
    {
        $rootScope.alerts.push({'type': type,'msg': msg, close: function(){alertService.closeAlert(this)} });
    }




    alertService.closeAlert = function(alert)
    {
        $rootScope.alerts.splice( $rootScope.alerts.indexOf(alert), 1);

    }


    return alertService;

});


app.service('authService',function(){

    var user = {};






    return{
        getUser: function(){


         alert(user.role);

              return user;
        },

        setUser: function(u)
        {

            user = u;
        }

    }


});

app.directive('restrict',function(authService){

    return {
        restrict: 'A',
        priority: -10000,
        scope: false,


     compile: function(element,attrs,linker)
        {
            var accessDenied = true;


            var user = authService.getUser();




            var attributes = attrs.access.split(" ");
            for(var i in attributes)
            {
                if(user.role==attributes[i]){
                    accessDenied= false;
                }
            }

            if(accessDenied){
                element.children().remove();
                element.remove();
            }
        }



    }



});






app.controller('mainCtrl',function($scope,$modal,$http,$window,authService){


    $scope.user = {};



    $http.get('../api/login').success(function(data){


        if(!data.loggedIn){



            $window.location.href = "http://" + $window.location.host ;
        }

        else
        {


            $scope.user = true;







        }


    });



    $scope.role = function(String)
    {
             return

    }

    $scope.admin = true;

    $scope.open = function () {

        $modal.open({
            animation: true,
            templateUrl: 'views/about.html'
            //controller: 'ModalInstanceCtrl',

        });


    };

    $scope.logout = function()
    {
        $http.get('../api/logout').success(function(){


            $window.location.href ="http://" + $window.location.host

        });
    }

});




function registerEmpCrtl($scope, $http, $location) {
   // $scope.master = {};
    $scope.activePath = null;
    $scope.add_emp = function(Employee) {

        $http.post('../api/employee', Employee).success(function(){
            $scope.reset();
            $scope.activePath = $location.path('/EditEmployee');
        });
        $scope.reset = function() {
            $scope.employee = {};// angular.copy($scope.master);
        };
       // $scope.reset();
    };
}

function ListEmpCtrl($scope, $http,$modal,$log) {




    function refresh()
    {

            $http.get('../api/employees').success(function(data) {
                $scope.Employees = data;
            });

    }

    refresh();


    $scope.update = function(Employee)
    {

        var modalInstance = $modal.open({
                animation: true,
                templateUrl: 'views/updateEmployeeForm.html',
                controller: UpdateEmpCrtl,
                resolve: {
                    Employee: function () {
                        return Employee;
                    }
                }

            });

        modalInstance.result.then(refresh);
    };



    $scope.delete = function(Employee)
    {
        var modalInstance=  $modal.open({
            animation: true,
            templateUrl: 'views/deleteConform.html',
            controller:  DeleteConformCtrl,
            resolve: {
                Name: function () {
                    return Employee.EmpName;
                }
            }

        });
        modalInstance.result.then(function(Success){

             if(Success)
            $http['delete']('../api/employee/'+Employee.EmpId).success(function(){


                refresh();
            });
        });

    }


}

function UpdateEmpCrtl($scope,$http,Employee,$modalInstance)
{

    $scope.Employee= angular.copy(Employee);

   // $scope.Employee.dob= new Date($filter('date')($scope.Employee.dob, "yy/MM/dd")); // for type="date" binding
    $scope.cancel = function(){

        $modalInstance.close(false);
    }

    $scope.update = function()
    {
        $http.put('../api/employee', $scope.Employee).success(function(){

            $modalInstance.close(true);
        });
    }

}



function registerStudentCrtl($scope,$http,$location)
{


    $scope.add_student = function(Student) {

        $http.post('../api/student', Student).success(function(){

            $scope.activePath = $location.path('/');

        });
        $scope.reset = function() {
            $scope.Student = {};
        };
        //$scope.reset();
    };


}



function ListStudentCtrl($scope, $http,$modal,isApproved) {




   if(isApproved>=0) {
       $scope.search = {};
       $scope.search.approved = isApproved;

       $scope.actionDisabled = true;

   }



    function refresh()
    {

            $http.get('../api/students').success(function(data) {
                $scope.Students = data;
            });

    }

    refresh();


    $scope.update = function(Student)
    {

        var modalInstance = $modal.open({
            animation: true,
            templateUrl: 'views/updateStudentForm.html',
            controller: UpdateStudentCrtl,
            resolve: {
                Student: function () {
                    return Student;
                }
            }

        });

        modalInstance.result.then(refresh);
    };



    $scope.delete = function(Studnet)
    {
        var modalInstance=  $modal.open({
            animation: true,
            templateUrl: 'views/deleteConform.html',
            controller:  DeleteConformCtrl,
            resolve: {
                Name: function () {
                    return Studnet.FirstName+" "+Studnet.LastName;
                }
            }

        });
        modalInstance.result.then(function(Sucess)
        {
            $http['delete']('../api/student/'+Studnet.student_id).success(function(){


                refresh()
            });
        });

    }


}

function UpdateStudentCrtl($scope,$http,Student,$modalInstance)
{

    $scope.Student= angular.copy(Student);

    // $scope.Employee.dob= new Date($filter('date')($scope.Employee.dob, "yy/MM/dd")); // for type="date" binding
    $scope.cancel = function(){

        $modalInstance.close(false);
    }

    $scope.update = function()
    {
        $http.put('../api/student', $scope.Student).success(function(){

            $modalInstance.close(true);
        });
    }

}









function courseDetailCtrl($scope, $http,$modal) {


$scope.reset = function reset()
{
    $scope.isUpdating = false;
    $scope.submitText = "Add";
    $scope.formHeader = "Add new Course";
    $scope.currentCourse = {};

}




    function refresh()
    {

            $http.get('../api/courses').success(function(data) {
                $scope.Courses = data;
            });

        $scope.reset();

    }

    refresh();


    $scope.startUpdate = function(Course)
    {

        $scope.submitText = "Update";
        $scope.formHeader = "Update Course " + Course.courseNumber;
        $scope.isUpdating = true;
        $scope.currentCourse = angular.copy(Course);




    }


    $scope.updateOrAdd = function(Course)
    {

         if($scope.isUpdating) {

             $http.put('../api/course', Course).success(function () {

                 refresh(true);

             });
         }
        else
         {
             $http.post('../api/course', Course).success(function(){

                 refresh(true);

             });


         }


    };



    $scope.delete = function(Course)
    {

        var modalInstance=  $modal.open({
            animation: true,
            templateUrl: 'views/deleteConform.html',
            controller:  DeleteConformCtrl,
            resolve: {
                Name: function () {
                    return Course.courseName;
                }
            }

        });
        modalInstance.result.then(function(Success)
        {
            if(Success)
            {
                $http['delete']('../api/course/'+Course.courseNumber).success(function(){
                    refresh();
                });
            }

        });


    }


}


function DeleteConformCtrl($scope,$http,Name,$modalInstance)
{
    $scope.name = Name;

    $scope.cancel = function(){

        $modalInstance.close(false);
    }

    $scope.delete = function()
    {
        $modalInstance.close(true);

    }
}



function enrollmentController($scope,$http,$filter,AppAlert)
{
    var addedEnrollments =[];
    $http.get('../api/courses').success(function(data) {
        $scope.Courses = data;
    });

    $scope.refresh= function()
    {

        $scope.currentEnrolment= {};

        $http.get('../api/enrollments').success(function(data) {
            $scope.Enrollments = data;
        });

        $http.get('../api/students').success(function(data) {

            var filter = {};
            filter.approved = 0;
            $scope.pendingStudents= $filter('filter')(data, filter)

        });


    }


    $scope.refresh();






    $scope.enroll = function(Student)
    {
        if($scope.currentEnrolment.year && $scope.currentEnrolment.courseNumber )
        {
           var enrolment = angular.copy($scope.currentEnrolment);
            enrolment.Student = Student;
           var date = new Date();
            enrolment.registrationDate =  (date.getMonth()+1)+'/'+ date.getDate()+'/'+date.getFullYear();

            $scope.Enrollments.push(enrolment);
            addedEnrollments.push(enrolment);

        }


        else
        {
            AppAlert.add("danger", "Please Select Year and Course to Enroll Student!");
        }
    }


    $scope.save = function()
    {

        for(var x in addedEnrollments) {
                 $http.post('../api/enrollment', addedEnrollments[x]).success(function () {


                 });
             }

        $scope.refresh();


    }




}


function studentStatusCtrl($scope,$http)
{
    $scope.currentStudent = {};
    $scope.currentStudent.approved = 0;
    $scope.search = function(id)
    {
        $http.get('../api/student/'+id).success(function(data) {
            $scope.currentStudent = data;
        });

    }

    $scope.searchByName = function(FirstName,LastName)
    {
        $http.get('../api/student?FirstName='+FirstName+'&LastName='+LastName).success(function(data) {
            $scope.currentStudent = data;
        });
    }


}