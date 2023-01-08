// $(document).ready(function () {
//     // function charts() {
//     //  ``   $.ajax({
//     //         type: "GET",
//     //         url: "/api/dashboard/saleschart",
//     //         dataType: "json",
//     //         success: function (data) {
//     //             console.log(data);
//     //             var ctx = $("#titleChart");
//     //             var myBarChart = new Chart(ctx, {
//     //                 type: 'bar',
//     //                 data: {
//     //                     labels: data.labels,
//     //                     datasets: [{
//     //                         label: 'Services Sales',
//     //                         data: data.data,
//     //                         backgroundColor: [
//     //                             'rgba(75, 192, 192, 0.2)',
//     //                             'rgba(255, 99, 132, 0.2)',
//     //                             'rgb(255,0,0)',
//     //                             'rgb(255,0,255)'
//     //                         ],
//     //                         borderColor: [
//     //                             'rgba(75, 192, 192, 1)',
//     //                             'rgba(255,99,132,1)'
//     //                         ],
//     //                         borderWidth: 1,
//     //                         borderRadius: Number.MAX_VALUE,
//     //                         borderSkipped: false,
//     //                     }]
//     //                 },
//     //                 options: {
//     //                     responsive: true,
//     //                     plugins: {
//     //                         legend: {
//     //                             position: 'top',
//     //                         }
//     //                     }
//     //                 },
//     //             });

//     //         },
//     //         error: function (error) {
//     //             console.log(error);
//     //         }
//     //     });``

//         $.ajax({
//             type: "GET",
//             url: "/api/dashboard/saleschart",
//             dataType: "json",
//             success: function (data) {
//                 console.log(data);

//                 new Chart(document.getElementById("salesChart")){
//                 // var ctx = document.;
//                 var myBarChart = new Chart(ctx, {
//                     type: 'line',
//                     data: {
//                         labels: data.labels,
//                         datasets: [{
//                             label: 'Monthly sales',
//                             data: data.data,
//                             backgroundColor: [
//                                 'rgba(75, 192, 192, 0.2)',
//                                 'rgba(255, 99, 132, 0.2)'
//                             ],
//                             borderColor: [
//                                 'rgba(75, 192, 192, 1)',
//                                 'rgba(255,99,132,1)'
//                             ],
//                             borderWidth: 1
//                         }]
//                     },
//                     options: {
//                         scales: {
//                             y: {
//                                 beginAtZero: true
//                             }
//                         }
//                     },
//                 });
    
//             },
//             error: function (error) {
//                 console.log(error);
//             }
//         });
// });

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/dashboard/saleschart",
        dataType: "json",
        success: function (data) {
            console.log(data);

            new Chart(document.getElementById("salesChart"), {
                
                type: 'pie',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Services sales',
                        data: data.data,
                        backgroundColor: [
                            "#FFA07A", "#EC771C","#3cba9f","#e8c3b9","#c45850"
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  },
                  
            // });

                });

            
        },
        error: function (error) {
            console.log(error);
        }
    });

     // product chart
     $.ajax({
        type: "GET",
        url: "/api/dashboard/serviceChart",
        dataType: "json",
        success: function (data) {
            console.log(data);

            new Chart(document.getElementById("serviceChart"), {
                
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Services offered',
                        data: data.data,
                        backgroundColor: [
                            "#9633FF", "#0D30F5","#3cba9f","#e8c3b9","#c45850"
                        ],
                        borderColor: [
                            'rgb(205, 92, 92)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  },
                  
            // });

                });

            
        },
        error: function (error) {
            console.log(error);
        }
    });

    $.ajax({
        type: "GET",
        url: "/api/dashboard/instrumentChart",
        dataType: "json",
        success: function (data) {
            console.log(data);

            new Chart(document.getElementById("instrumentChart"), {
                
                type: 'polarArea',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Instruments available:',
                        data: data.data,
                        backgroundColor: [
                            "#ECFF33", "#68FF33","#C81B57","#e8c3b9","#c45850"
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  },

                });

            
        },
        error: function (error) {
            console.log(error);
        }
    });

    $.ajax({
        type: "GET",
        url: "/api/dashboard/instructorChart",
        dataType: "json",
        success: function (data) {
            console.log(data);

            new Chart(document.getElementById("instructorChart"), {
                
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Total no. of Instructors',
                        data: data.data,
                        backgroundColor: [
                            "#FF5733", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  },

                });

            
        },
        error: function (error) {
            console.log(error);
        }
    });

    $.ajax({
        type: "GET",
        url: "/api/dashboard/conditionChart",
        dataType: "json",
        success: function (data) {
            console.log(data);

            new Chart(document.getElementById("conditionChart"), {
                
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Instruments condition:',
                        data: data.data,
                        backgroundColor: [
                            "#ECFF33", "#68FF33","#C81B57","#e8c3b9","#c45850"
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  },

                });

            
        },
        error: function (error) {
            console.log(error);
        }
    });
});