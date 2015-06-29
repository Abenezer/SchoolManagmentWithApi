var app = angular.module('SRMSApp',['ngRoute','ui.validate','ui.bootstrap']).
    config(function($routeProvider) {
        $routeProvider.
            when('/', {templateUrl: 'views/home.html'}).
            when('/AddEmployee', {templateUrl: 'views/EmployeeRegistration.html',controller: AddCtrl}).
            when('/CourseDetail', {templateUrl: 'views/CourseDetailForm.html'}).
            when('/EnrollStudent', {templateUrl: 'views/Enroll.html'}).
            when('/EditStudent', {templateUrl: 'views/updateStudentForm.html'}).
            when('/EditEmployee', {templateUrl: 'views/listEmployees.html',controller:ListCtrl }).
            when('/StudentStatus', {templateUrl: 'views/studentStatus.html'}).
            when('/ApprovedStudents', {templateUrl: 'views/approvedStudents.html'}).
            when('/PendingStudents', {templateUrl: 'views/pendingStudents.html'}).

            when('/about', {templateUrl: 'views/about.html'}).
            otherwise({redirectTo: '/'});
    })





    ;

app.controller('mainCtrl',function($scope,$modal){


    $scope.open = function () {

        $modal.open({
            animation: true,
            templateUrl: 'views/about.html'
            //controller: 'ModalInstanceCtrl',

        });


    };

});








function AddCtrl($scope, $http, $location) {
    $scope.master = {};
    $scope.activePath = null;
    $scope.add_emp = function(Employee) {

        $http.post('../api/add_emp', Employee).success(function(){
            $scope.reset();
            $scope.activePath = $location.path('/');
        });
        $scope.reset = function() {
            $scope.employee = angular.copy($scope.master);
        };
        $scope.reset();
    };
}

function ListCtrl($scope, $http,$modal,$log,$location) {
    $http.get('../api/employees').success(function(data) {
        $scope.Employees = data;
    });


    $scope.update = function(Employee)
    {



        var modalInstance =    $modal.open({
                animation: true,
                templateUrl: 'views/updateEmployeeForm.html',
                controller: UpdateEmp,
                resolve: {
                    Employee: function () {
                        return Employee;
                    }
                }

            });

        modalInstance.result.then(function (UpdatedEmployee) {

            //   Employee.EmpName = UpdatedEmployee.EmpName;
            $http.get('../api/employees').success(function(data) {
                $scope.Employees = data;
            });
           // Employee.$apply();

        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };


    $scope.delete = function(Employee)
    {
        var modalInstance=  $modal.open({
            animation: true,
            templateUrl: 'views/deleteConform.html',
            controller:  DeleteEmp,
            resolve: {
                Employee: function () {
                    return Employee;
                }
            }

        });

        modalInstance.result.then(function (success) {

            if(success)
            //   Employee.EmpName = UpdatedEmployee.EmpName;
            $http.get('../api/employees').success(function(data) {
                $scope.Employees = data;
            });
            // Employee.$apply();

        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }


}

function UpdateEmp($scope,$http,Employee,$modalInstance)
{

    $scope.Employee= angular.copy(Employee);

   // $scope.Employee.dob= new Date($filter('date')($scope.Employee.dob, "yy/MM/dd")); // for type="date" binding
    $scope.cancel = function(){

        $modalInstance.close(false);
    }

    $scope.update = function()
    {
        $http.put('../api/update_emp', $scope.Employee).success(function(){

            $modalInstance.close(true);
        });
    }

}

function DeleteEmp($scope,$http,Employee,$modalInstance)
{



    $scope.name = Employee.EmpName;
    // $scope.Employee.dob= new Date($filter('date')($scope.Employee.dob, "yy/MM/dd")); // for type="date" binding
    $scope.cancel = function(){

        $modalInstance.close(false);
    }

    $scope.delete = function()
    {
        $http.get('../api/delete_emp/'+Employee.EmpId).success(function(){


            $modalInstance.close(true);
        });
    }

}




/*
 var app=angular.module('single-page-app',['ngRoute']);

 app.config(function($routeProvider){
 $routeProvider
 .when('/',{
 templateUrl: 'views/list.html'
 })
 .when('/about',{
 templateUrl: 'views/about.html'
 })
 .when('/blog',{
 templateUrl: 'views/blog.html'
 });
 });
 */