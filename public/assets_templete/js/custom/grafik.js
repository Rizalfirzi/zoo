const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        // style: "currency",
        currency: "IDR"
    }).format(number);
}
function ReplaceNumberWithCommas(yourNumber) {
    //Seperates the components of the number
    var n = yourNumber.toString().split(".");
    //Comma-fies the first part
    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //Combines the two sections
    return n.join(".");
}

function onChangeSelect(token_csrf, url, id, name, placeholder) {
    // send ajax request to get the cities of the selected province and append to the select tag

    $.ajax({
        url: '../../' + url,
        type: 'POST',
        data: {
            id_prov: id,
            _token: token_csrf
        },
        success: function (response) {
            $('#' + name).empty();
            $('#' + name).append('<option>' + placeholder + '</option>');
            // $.each(data, function(key, value) {
            //     $('#' + name).append('<option value="' + key + '">' + value + '</option>');
            // });
            $.each(response, function (key, value) {
                $('#' + name).append(new Option(value.nm, value
                    .id))
                // $('#' + name).append(new Option(value.nm_kabkota, value
                // .id_kabkota))
            })
        }
    });
}
function ChartJenisKelamin(token, url, nm_title, id_prov, id_kabkota) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_prov: id_prov,
            id_kabkota: id_kabkota,
            _token: token
        },
        dataType: 'json',
        success: function (response) {
            $("#jml_laki").text(parseFloat(response[0].lk).toLocaleString(window.document
                .documentElement.lang));
            $("#jml_perempuan").text(parseFloat(response[0].pr).toLocaleString(window.document
                .documentElement.lang));
            $("#jml_total").text(parseFloat(response[0].total).toLocaleString(window.document
                .documentElement.lang));

            // if(response[0].sources != null){
                $("#sources").html("Sumber : <a target='_blank' href='" + response[0].sources + "'>" + response[0].sources + "</a>");
            // }



            var nm_partai = [];
            var total_partai = [];
            var total_int = [];
            // console.log('respone : ' + response[0].lk);
            $.each(response, function (key, value) {

                nm_partai['laki'] = value.lk
            })
            $.each(response, function (key, value) {
                total_partai['perem'] = value.pr
            })
            // console.log(nm_partai);
            // console.log('----');
            // console.log(total_partai);

            Highcharts.chart('container_jenisKelamin', {
                chart: {
                    backgroundColor: null,
                    margin: [0, 0, 0, 0],
                    spacingTop: 0,
                    spacingBottom: 0,
                    spacingLeft: 0,
                    spacingRight: 0,
                    height: '50%',
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 50,
                        beta: 0
                    }
                },
                title: {
                    text: null,
                    align: 'left'
                },
                subtitle: {
                    text: null,
                    align: 'left'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: '<b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        size: '100%',
                        depth: 15,
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.percentage:.1f}%</b>',//{point.name} <b>
                            distance: 5
                            // distance: -55,
                        }
                    }
                },
                // subtitle: {
                //     text: 'Source : Mr. Yoga Budiman',
                //     align: 'left',
                //     style: {
                //         color: '#9193a6',
                //         fontWeight: 'bold'
                //     }
                // },
                series: [{
                    type: 'pie',
                    name: 'Jenis Kelamin',
                    data: [
                        {
                            y: parseInt(response[0].lk),
                            name: "Laki-laki",
                            color: "#0034b5"
                        },
                        {
                            y: parseInt(response[0].pr),
                            name: "Perempuan",
                            color: "#da2861"
                        }
                    ]
                }]
            });
        }
    });
}
function getDataAgama(token, url, nm_title, id_prov) {
    var id_kategori = 1;
    Highcharts.chart('container_agama', {

        chart: {
            type: 'bar',
            // height: 1300,
            backgroundColor: '#0d1623', //0d1623
        },

        plotOptions: {
            column: {
                colorByPoint: true
            }
        },

        title: {
            text: ' ',
            align: 'center',
            style: {
                color: '#9193a6',
                // fontWeight: 'bold'
            }
        },


        xAxis: {
            categories: ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Budda', 'Konghucu'],
            title: {
                text: null,
            },
            labels: {
                style: {
                    fontWeight: 'bold',
                    color: '#9193a6',
                },
                useHTML: true
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            itemStyle: {
                color: '#9899a6',
                fontWeight: 'bold'
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: ['Total Jiwa'],
            data: [143088869, 10598357, 5186144, 3183997, 1618357, 437420],
            // colors: ['#2f7ed8','#910000','#8bbc21','#ffffff','#2f7ed8','#910000'],
            borderWidth: 0,
            // borderColor: 'black',
            color: {
                linearGradient: {
                    x1: 0,
                    x2: 0,
                    y1: 0,
                    y2: 0.9
                },
                stops: [

                    [0, '#006cb5'],
                    [1, '#0034b5'],
                ]
            },
            // color: '#0034b5'
        }]
    });
}
function getDataPresidenLama(token, url) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            _token: token
        },
        dataType: 'json',
        success: function (response) {

            var nm_partai = [];
            var paslon01 = [];
            var paslon02 = [];

            $.each(response, function (key, value) {
                nm_partai[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                paslon01[key] = value.paslon01
            })
            $.each(response, function (key, value) {
                paslon02[key] = value.paslon02
            })

            Highcharts.chart('containerPresiden', {
                chart: {
                    type: 'bar',
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 50 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: ' ',
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_partai,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        // formatter: function() {
                        //     return '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3VZ64Z7YAQhuJKffegy7Ksl3Yd5O7WJxkNEuGtnZN_g&s" alt="" style="vertical-align: middle; width: 32px; height: 32px"/>   ' +
                        //         this.value;
                        // },
                        useHTML: true
                    }
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                series: [{
                    name: "Jokowi & Ma'ruf",
                    data: paslon01,
                    legendColor: '#ffffff',
                    color: '#d01822',
                    borderWidth: 0,
                    useHTML: true,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 1
                        },
                        stops: [

                            [0, '#d9464e'],
                            [1, '#d01822'],
                        ]
                    }
                }, {
                    name: 'Prabowo & Sandiaga',
                    data: paslon02,
                    color: '#fff',
                    borderWidth: 0,
                }]
            });
        }
    });
}
function getDataPemiluPartai(token, url, id_parpol, icon_partai) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_parpol: id_parpol,
            _token: token
        },
        dataType: 'json',
        success: function (response) {

            var nm_partai = [];
            var total_partai = [];

            $.each(response, function (key, value) {
                // nm_partai[key] = value.nm_provinsi + ' ( ' + value.icon + ' )</b> '
                nm_partai[key] = value.nm_parpol + "   <img src=" + icon_partai + '/' + value
                    .icon.toUpperCase() + '.png' + " width=30 heigh=30 >"
            })
            $.each(response, function (key, value) {
                total_partai[key] = value.total
            })

            // console.log(total_partai)
            Highcharts.chart('containerPemiluPartai', {
                chart: {
                    type: 'bar',
                    // height: 1300,
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 400;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: ' ',
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                // subtitle: {
                //     text: 'Source : Mr. Yoga Budiman',
                //     align: 'left',
                //     style: {
                //         color: '#9193a6',
                //         fontWeight: 'bold'
                //     }
                // },

                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_partai,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        useHTML: true
                    }
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Jumlah Pemilih Parpol',
                    data: total_partai,
                    borderWidth: 0,
                    borderColor: 'black',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    }
                    // color: '#0034b5'
                }]
            });
        }
    });
}
function getDataPemiluPartaiprov(token, url, id_prov, icon_partai) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_prov: id_prov,
            _token: token
        },
        dataType: 'json',
        success: function (response) {

            var nm_partai = [];
            var total_partai = [];

            $.each(response, function (key, value) {
                // nm_partai[key] = value.nm_provinsi + ' ( ' + value.icon + ' )</b> '
                nm_partai[key] = value.nm_provinsi + "   <img src=" + icon_partai + '/' + value
                    .icon.toUpperCase() + '.png' + " width=30 heigh=30 >"
            })
            $.each(response, function (key, value) {
                total_partai[key] = value.total
            })

            // console.log(total_partai)
            Highcharts.chart('containerPemiluPartaiprov', {
                chart: {
                    type: 'bar',
                    // height: 1300,
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 400;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: ' ',
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                // subtitle: {
                //     text: 'Source : Mr. Yoga Budiman',
                //     align: 'left',
                //     style: {
                //         color: '#9193a6',
                //         fontWeight: 'bold'
                //     }
                // },

                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_partai,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        useHTML: true
                    }
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Jumlah Pemilih Parpol',
                    data: total_partai,
                    borderWidth: 0,
                    borderColor: 'black',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    }
                    // color: '#0034b5'
                }]
            });
        }
    });
}

function getDataChart(token, url, title, id_prov) { // pendidikan
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_prov: id_prov,
            _token: token
        },
        dataType: 'json',
        success: function (response) {

            var nm_partai = [];
            var sd = [];
            var smp = [];
            var sma = [];
            $.each(response, function (key, value) {
                nm_partai[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                sd[key] = parseFloat(value.sd)
            })
            $.each(response, function (key, value) {
                smp[key] = parseFloat(value.smp)
            })
            $.each(response, function (key, value) {
                sma[key] = parseFloat(value.sma)
            })

            Highcharts.chart('container_pendidikan', {
                chart: {
                    type: 'bar',
                    height: 300,
                    backgroundColor: '#0d1623', //0d1623
                },
                title: {
                    text: ' ',
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: ['SD / Sederajat', 'SMP / Sederajat', "SMA / Sederajat"],
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        // formatter: function() {
                        //     return '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3VZ64Z7YAQhuJKffegy7Ksl3Yd5O7WJxkNEuGtnZN_g&s" alt="" style="vertical-align: middle; width: 32px; height: 32px"/>   ' +
                        //         this.value;
                        // },
                        useHTML: true
                    }
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true,
                            style: {
                                textOutline: false,
                                color: '#ffffff'
                            }
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                tooltip: {
                    pointFormatter: function () {
                        valueDecimals: 2,
                            point = this,
                            series = point.series;
                        return `${series.name}: <b>${point.y}</b><br/>`
                    },
                    valueSuffix: ' ',
                    shared: true
                },

                series: [{

                    pointFormat: '{series.name}: <b>{point.y:.2f}</b><br/>',
                    name: title,
                    data: [parseFloat(response[0].sd), parseFloat(response[0].smp),
                    parseFloat(response[0].sma)
                    ],
                    borderWidth: 0,
                    pointPadding: 0,
                    dataLabels: {
                        format: '{y}',
                    },
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    }
                    // }, {
                    //     name: 'SMP',
                    //     data: smp,
                    //     color: '#3539e8',
                    //     borderWidth: 0,
                    // }, {
                    //     name: 'SMA',
                    //     data: sma,
                    //     color: '#808080',
                    //     borderWidth: 0,
                }]
            });
        }
    });
}
function getDataChartMiskinNasional(token_csrf, url, nm_title, id_prov) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_kategori: id_kategori,
            id_prov: id_prov,
            _token: token_csrf
        },
        dataType: 'json',
        success: function (response) {

            var nm_partai = [];
            var total_partai = [];
            var total_int = [];
            $.each(response, function (key, value) {

                nm_partai[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                total_partai[key] = parseInt(value.jum_prov)
            })
            // console.log(nm_partai);
            // console.log('----');
            // console.log(total_partai);
            Highcharts.chart('containerMiskin', {
                chart: {
                    type: 'bar',
                    // height: 1300,
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: null,//'Jumlah Penduduk Kemiskinan Per ' + nm_title,
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_partai,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        // useHTML: true
                    }
                },
                yAxis: {
                    min: 0,
                    // title: {
                    //     text: 'Populasi',
                    //     align: 'high'
                    // },
                    // labels: {
                    //     overflow: 'justify'
                    // },
                    // gridLineColor: '#b6b8cc'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                series: [{
                    name: nm_title,
                    data: total_partai,
                    borderWidth: 0,
                    // borderColor: 'black',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    },
                    // color: '#0034b5'
                }]
            });
        }
    });
}
function getDataChartPengangguranNasional(token_csrf, url, nm_title, id_prov) {
    var id_kategori = 2;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_kategori: id_kategori,
            id_prov: id_prov,
            _token: token_csrf
        },
        dataType: 'json',
        success: function (response) {

            var nm_partai = [];
            var total_partai = [];
            var total_int = [];
            $.each(response, function (key, value) {

                nm_partai[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                total_partai[key] = parseFloat(value.jum_prov)
            })
            // console.log(nm_partai);
            // console.log('----');
            // console.log(total_partai);
            Highcharts.chart('containerPengangguran', {
                chart: {
                    type: 'bar',
                    // height: 1300,
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: null, //'Jumlah Penduduk Pengangguran Per ' + nm_title,
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_partai,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        // useHTML: true
                    }
                },
                // yAxis: {
                //     min: 0,
                //     title: {
                //         text: 'Populasi',
                //         align: 'high'
                //     },
                //     labels: {
                //         overflow: 'justify'
                //     },
                //     gridLineColor: '#b6b8cc'
                // },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    },

                },
                credits: {
                    enabled: false
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    pointFormatter: function () {
                        valueDecimals: 2,
                            point = this,
                            series = point.series;
                        return `${series.name}: <b>${point.y}</b><br/>`
                    },
                    valueSuffix: ' ',
                    shared: true
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                series: [{

                    name: nm_title,
                    data: total_partai,
                    borderWidth: 0,
                    dataLabels: {
                        format: '{y}',
                    },
                    // borderColor: 'black',
                    valueDecimals: 2,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    },
                    // color: '#0034b5'
                }]
            });
        }
    });
}
function getDataChartKepadatanPenduduk(token_csrf, url, nm_title, id_prov) {
    var id_kategori = 2;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_kategori: id_kategori,
            id_prov: id_prov,
            _token: token_csrf
        },
        dataType: 'json',
        success: function (response) {

            var nm_partai = [];
            var total_partai = [];
            var total_int = [];
            $.each(response, function (key, value) {

                nm_partai[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                total_partai[key] = parseFloat(value.tot_padat)
            })
            // console.log(nm_partai);
            // console.log('----');
            // console.log(total_partai);
            Highcharts.chart('containerKepadatanPenduduk', {
                chart: {
                    type: 'bar',
                    height: 1300,
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: null, //'Kepadatan Penduduk ' + nm_title,
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_partai,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        // useHTML: true
                    }
                },
                // yAxis: {
                //     min: 0,
                //     title: {
                //         text: 'Populasi',
                //         align: 'high'
                //     },
                //     labels: {
                //         overflow: 'justify'
                //     },
                //     gridLineColor: '#b6b8cc'
                // },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    },

                },
                credits: {
                    enabled: false
                },

                tooltip: {
                    pointFormatter: function () {
                        valueDecimals: 2,
                            point = this,
                            series = point.series;
                        return `${series.name}: <b>${point.y} km<sup>2</sup> </b><br/>`
                    },
                    valueSuffix: ' ',
                    shared: true
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                series: [{

                    name: nm_title,
                    data: total_partai,
                    borderWidth: 0,
                    dataLabels: {
                        format: '{y}',
                    },
                    // borderColor: 'black',
                    valueDecimals: 2,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    },
                    // color: '#0034b5'
                }]
            });
        }
    });
}
function getDataChartpodesJumlahDataNasional(token_csrf, url, nm_title, id_prov) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_kategori: id_kategori,
            id_prov: id_prov,
            _token: token_csrf
        },
        dataType: 'json',
        success: function (response) {
            $("#subtitle").text('JUMLAH KABUPATEN / KOTA PER PROVINSI');
            var nm_partai = [];
            var total_partai = [];
            var total_int = [];
            $.each(response, function (key, value) {

                nm_partai[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                total_partai[key] = value.jum_kabkota
            })

            Highcharts.chart('containerPodesNasional', {
                chart: {
                    type: 'bar',
                    height: 1300,
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: null, //'Jumlah Kabupaten / Kota Per ' + nm_title,
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_partai,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        // useHTML: true
                    }
                },
                // yAxis: {
                //     min: 0,
                //     title: {
                //         text: 'Populasi',
                //         align: 'high'
                //     },
                //     labels: {
                //         overflow: 'justify'
                //     },
                //     gridLineColor: '#b6b8cc'
                // },
                plotOptions: {
                    bar: {

                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                series: [{
                    name: nm_title,
                    data: total_partai,
                    borderWidth: 0,
                    // borderColor: 'black',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    },
                    // color: '#0034b5'
                }]
            });
        }
    });
}
function getDataChartProvinsi(token_csrf, url, id_prov, title) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_prov: id_prov,
            _token: token_csrf
        },
        dataType: 'json',
        success: function (response) {

            var nm_partai = [];
            var paslon01 = [];
            var paslon02 = [];

            $.each(response, function (key, value) {
                nm_partai[key] = value.nm_kabkota
            })
            $.each(response, function (key, value) {
                paslon01[key] = value.jum_kec
            })
            $.each(response, function (key, value) {
                paslon02[key] = value.jum_desa
            })
            $("#subtitle").text('JUMLAH KECAMATAN & DESA DI ' + title);
            // console.log(nm_partai.length);
            // console.log('======');
            // console.log(paslon02);
            Highcharts.chart('containerPodesNasional', {
                chart: {
                    type: 'bar',
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: null,//'Jumlah Data Kecamatan dan Desa Per Kabupaten di ' + title,
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_partai
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Goals'
                    }
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                // legend: {
                //     reversed: true
                // },
                plotOptions: {
                    series: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            style: {
                                textOutline: false,
                                color: '#FFFFFF'
                            }
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Desa',
                    data: paslon02,
                    borderWidth: 0,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    },
                }, {
                    name: 'Kecamatan',
                    data: paslon01,
                    borderWidth: 0,
                    color: '#da2861'
                }]
            });

        }
    });
}
function getDataChartAgama(token, url, nm_title, id_prov, id_kabkota) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_prov: id_prov,
            _token: token
        },
        dataType: 'json',
        success: function (response) {
            var nm_partai = [];
            var total_partai = [];
            var total_int = [];
            // console.log('respone : ' + response[0].lk);
            $.each(response, function (key, value) {
                nm_partai[key] = value.nm_agama
            })
            $.each(response, function (key, value) {
                total_partai[key] = value.jumlah
            })
            // console.log(nm_partai);
            // console.log('----');
            // console.log(total_partai);

            Highcharts.chart('agama_chart', {
                chart: {
                    backgroundColor: null,
                    type: 'bar',

                    events: {
                        load: function () {
                            let categoryHeight = 30 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                legend: {
                    enabled: false
                },
                title: {
                    text: null,
                    align: 'left'
                },
                subtitle: {
                    text: null,
                    align: 'left'
                },
                xAxis: {
                    categories: nm_partai,
                    title: {
                        text: null
                    },
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: null,
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    },
                    gridLineColor: '#b6b8cc'
                },
                tooltip: {
                    pointFormat: '<b>{point.y:.1f}</b>'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    },
                    series: {
                        // stacking: 'normal',
                        borderWidth: 0,
                        pointWidth: 50,
                        pointPadding: 0,
                        dataLabels: {
                            format: '{y}',
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    data: total_partai,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 1
                        },
                        stops: [
                            [0, '#0070ff'],
                            [1, '#0034b5']

                        ]
                    }
                }]
            });
        }
    });
}
function getDataChartAgamaProv(token, url, nm_title, id_prov, id_kabkota) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_prov: id_prov,
            _token: token
        },
        dataType: 'json',
        success: function (response) {
            var nm_partai = [];
            var total_partai = [];
            var total_int = [];

            var jumlah_data = [];
            jumlah_data.push(response[0].islam / response[0].jumlah * 100);
            jumlah_data.push(response[0].kristen / response[0].jumlah * 100);
            jumlah_data.push(response[0].katolik / response[0].jumlah * 100);
            jumlah_data.push(response[0].hindu / response[0].jumlah * 100);
            jumlah_data.push(response[0].buddha / response[0].jumlah * 100);
            jumlah_data.push(response[0].khonghucu / response[0].jumlah * 100);
            jumlah_data.push(response[0].lainnya / response[0].jumlah * 100);

            var nama = [];
            nama.push('Islam');
            nama.push('Kristen Protestan');
            nama.push('Kristen Katolik');
            nama.push('Hindu');
            nama.push('Buddha');
            nama.push('Khonghucu');
            nama.push('Agama Lainnya');

            Highcharts.chart('agama_chart', {
                chart: {
                    backgroundColor: null,
                    type: 'bar',
                    events: {
                        load: function () {
                            let categoryHeight = 30 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                legend: {
                    enabled: false
                },
                title: {
                    text: null,
                    align: 'left'
                },
                subtitle: {
                    text: null,
                    align: 'left'
                },
                xAxis: {
                    categories: nama,
                    title: {
                        text: null
                    },
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: null,
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    },
                    gridLineColor: '#b6b8cc'
                },
                tooltip: {
                    pointFormat: '<b>{point.y:.2f}</b>'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    },
                    series: {
                        // stacking: 'normal',
                        borderWidth: 0,
                        pointWidth: 50,
                        pointPadding: 0,
                        dataLabels: {
                            format: '{point.y:.2f}',
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{

                    data: jumlah_data,
                    valueDecimals: 2,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 1
                        },
                        stops: [
                            [0, '#0070ff'],
                            [1, '#0034b5']

                        ]
                    }
                }]
            });
        }
    });
}
function getDataChartUsia(token, url, nm_title, id_prov, id_kabkota) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_prov: id_prov,
            _token: token
        },
        dataType: 'json',
        success: function (response) {

            var age = [];
            var laki = [];
            var perempuan = [];

            $.each(response, function (key, value) {
                age[key] = value.umur
            })
            $.each(response, function (key, value) {
                laki[key] = parseInt(-value.laki)
            })
            $.each(response, function (key, value) {
                perempuan[key] = value.perempuan
            })

            var categories_age = age;
            // console.log(categories_age);
            Highcharts.chart('chart_usia', {
                chart: {
                    type: 'bar',
                    backgroundColor: null,
                },
                title: {
                    text: null,
                    align: 'left'
                },
                subtitle: {
                    text: null,
                    align: 'left'
                },
                accessibility: {
                    point: {
                        valueDescriptionFormat: '{index}. Age {xDescription}, {value}.'
                    }
                },
                xAxis: [{
                    categories: categories_age,
                    reversed: false,
                    labels: {
                        step: 1
                    },
                    accessibility: {
                        description: 'Age (male)'
                    }
                }, { // mirror axis on right side
                    opposite: true,
                    reversed: false,
                    categories: categories_age,
                    linkedTo: 0,
                    labels: {
                        step: 1
                    },
                    accessibility: {
                        description: 'Age (female)'
                    }
                }],
                yAxis: {
                    title: {
                        text: null
                    },
                    labels: {
                        formatter: function () {
                            return Math.abs(this.value);
                        }
                    },
                    accessibility: {
                        description: 'persentasi populasi',
                        rangeDescription: 'Range: 0 hingga 5%'
                    }
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        stacking: 'normal'
                    },

                },

                tooltip: {
                    formatter: function () {
                        return '<b>' + this.series.name + ', umur ' + this.point.category + '</b><br/>' +
                            'populasi: ' + Highcharts.numberFormat(Math.abs(this.point.y), 1);
                    }
                },
                legend: {
                    itemStyle: {
                        color: '#ffffff',
                    }
                },
                series: [{
                    name: 'Laki-laki',
                    data: laki,
                    color: "#0034b5",
                }, {
                    name: 'Perempuan',
                    data: perempuan,
                    color: "#da2861",
                }]
            });
        }
    });
}
function getDataChartUsiaProv(token, url, nm_title, id_prov, id_kabkota) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_prov: id_prov,
            _token: token
        },
        dataType: 'json',
        success: function (response) {

            var age_prov = [];
            var laki = [];
            var perempuan = [];



            laki.push(-response[0].l00_04);
            laki.push(-response[0].l05_09);
            laki.push(-response[0].l10_14);
            laki.push(-response[0].l15_19);
            laki.push(-response[0].l20_24);
            laki.push(-response[0].l25_29);
            laki.push(-response[0].l30_34);
            laki.push(-response[0].l35_39);
            laki.push(-response[0].l40_44);
            laki.push(-response[0].l45_49);
            laki.push(-response[0].l50_54);
            laki.push(-response[0].l55_59);
            laki.push(-response[0].l60_64);
            laki.push(-response[0].l65_69);
            laki.push(-response[0].l70_74);
            laki.push(-response[0].l75);

            perempuan.push(response[0].p00_04);
            perempuan.push(response[0].p05_09);
            perempuan.push(response[0].p10_14);
            perempuan.push(response[0].p15_19);
            perempuan.push(response[0].p20_24);
            perempuan.push(response[0].p25_29);
            perempuan.push(response[0].p30_34);
            perempuan.push(response[0].p35_39);
            perempuan.push(response[0].p40_44);
            perempuan.push(response[0].p45_49);
            perempuan.push(response[0].p50_54);
            perempuan.push(response[0].p55_59);
            perempuan.push(response[0].p60_64);
            perempuan.push(response[0].p65_69);
            perempuan.push(response[0].p70_74);
            perempuan.push(response[0].p75);

            age_prov.push('00-04');
            age_prov.push('05-09');
            age_prov.push('10-14');
            age_prov.push('15-19');
            age_prov.push('20-24');
            age_prov.push('25-29');
            age_prov.push('30-34');
            age_prov.push('35-39');
            age_prov.push('40-44');
            age_prov.push('45-49');
            age_prov.push('50-54');
            age_prov.push('55-59');
            age_prov.push('60-64');
            age_prov.push('65-69');
            age_prov.push('70-74');
            age_prov.push('75+');


            var categories_age_prov = age_prov;
            // console.log(categories_age_prov)
            // console.log(categories_age_prov)
            Highcharts.chart('chart_usia', {
                chart: {
                    type: 'bar',
                    events: {
                        load: function () {
                            let categoryHeight = 30 * nm_partai.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                    backgroundColor: null,
                },
                title: {
                    text: null,
                    align: 'left'
                },
                subtitle: {
                    text: null,
                    align: 'left'
                },
                accessibility: {
                    point: {
                        valueDescriptionFormat: '{index}. Age {xDescription}, {value}.'
                    }
                },
                xAxis: [{
                    categories: categories_age_prov,
                    reversed: false,
                    labels: {
                        step: 1
                    },
                    accessibility: {
                        description: 'Age (male)'
                    }
                }, { // mirror axis on right side
                    opposite: true,
                    reversed: false,
                    categories: categories_age_prov,
                    linkedTo: 0,
                    labels: {
                        step: 1
                    },
                    accessibility: {
                        description: 'Age (female)'
                    }
                }],
                yAxis: {
                    title: {
                        text: null
                    },
                    labels: {
                        formatter: function () {
                            return Math.abs(this.value);
                        }
                    },
                    accessibility: {
                        description: 'persentasi populasi',
                        rangeDescription: 'Range: 0 hingga 5%'
                    }
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        stacking: 'normal'
                    },

                },

                tooltip: {
                    formatter: function () {
                        return '<b>' + this.series.name + ', umur ' + this.point.category + '</b><br/>' +
                            'populasi: ' + Highcharts.numberFormat(Math.abs(this.point.y), 1);
                    }
                },
                legend: {
                    itemStyle: {
                        color: '#ffffff',
                    }
                },
                series: [{
                    name: 'Laki-laki',
                    data: laki,
                    color: "#0034b5",
                }, {
                    name: 'Perempuan',
                    data: perempuan,
                    color: "#da2861",
                }]
            });
        }
    });
}
function getDataChartKetenagakerjaanNasional(token, url, nm_title, id_prov, id_kabkota) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_prov: id_prov,
            _token: token
        },
        dataType: 'json',
        success: function (response) {

            var formal = response[0].formal;
            var informal = response[0].informal;

            Highcharts.chart('kerja_chart', {
                chart: {
                    type: 'column',
                    backgroundColor: null,
                },
                title: false,
                xAxis: {
                    categories: [
                        'Data Ketenagakerjaan'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Data (%)'
                    }
                },
                tooltip: {
                    pointFormat: '<b>{point.y:.1f}%</b>'
                },
                credits: {
                    enabled: false
                },
                legend: {
                    itemStyle: {
                        color: '#ffffff',
                    }
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    },
                    series: {
                        borderWidth: 0,
                        pointPadding: 0,
                        dataLabels: {
                            format: '{y} %',
                        }
                    }
                },
                series: [{
                    pointFormat: '{series.name}: <b>{point.y:.2f}</b><br/>',
                    name: 'Formal',
                    data: [formal],
                    color: '#0034b5'

                }, {
                    pointFormat: '{series.name}: <b>{point.y:.2f}</b><br/>',
                    name: 'informal',
                    data: [informal],
                    color: '#00ffff'


                }]
            });
        }
    });
}
function getDataChartKetenagakerjaanProv(token_csrf, url, id_prov, title) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            _token: token_csrf
        },
        dataType: 'json',
        success: function (response) {

            var nm_provinsi = [];
            var formal = [];
            var informal = [];

            $.each(response, function (key, value) {
                nm_provinsi[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                formal[key] = value.formal
            })
            $.each(response, function (key, value) {
                informal[key] = value.informal
            })
            // $("#subtitle").text('JUMLAH KECAMATAN & DESA DI ' + title);
            // console.log(nm_provinsi.length);
            // console.log('======');
            // console.log(informal);
            Highcharts.chart('chart_ketenagakerjaan_prov', {
                chart: {
                    type: 'bar',
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_provinsi.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: null,//'Jumlah Data Kecamatan dan Desa Per Kabupaten di ' + title,
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_provinsi
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Goals'
                    }
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                plotOptions: {
                    series: {
                        stacking: 'normal',

                    }
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    formatter: function () {
                        return '<b>' + this.x + ' % </b><br/>' +
                            this.series.name + ': ' + this.y + ' %<br/>';
                    }
                },
                // tooltip: {
                //     pointFormat: '<b>{x}{point.percentage:.1f} %</b>'
                // },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Informal',
                    data: informal,
                    borderWidth: 0,
                    color: '#00ffff',
                    dataLabels: {
                        format: '{y} %',
                        enabled: true,
                        style: {
                            textOutline: false,
                            color: '#060b16'
                        }
                    }
                }, {
                    name: 'Formal',
                    data: formal,
                    borderWidth: 0,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    },
                    dataLabels: {
                        format: '{y} %',
                        enabled: true,
                        style: {
                            textOutline: false,
                            color: '#FFFFFF'
                        }
                    }
                }]
            });

        }
    });
}

function getDataChartPengeluaranPerkapita(token_csrf, url, nm_title, id_prov) {
    var id_kategori = 2;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_kategori: id_kategori,
            id_prov: id_prov,
            _token: token_csrf
        },
        dataType: 'json',
        success: function (response) {

            var nm_provinsi = [];
            var pengeluaran_ok = [];
            $.each(response, function (key, value) {

                nm_provinsi[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                const rupiah_okok = rupiah(value.pengeluaran)
                const rupiah_ok = rupiah_okok.replace('Rp', '')
                pengeluaran_ok[key] = parseFloat(rupiah_okok)
                // pengeluaran_ok[key] = rupiah(value.pengeluaran)
                // console.log(rupiah_okok);
            })
            // console.log(nm_partai);
            // console.log('----');
            // console.log(pengeluaran_ok);
            Highcharts.chart('perkapita_chart', {
                chart: {
                    type: 'bar',
                    // height: 1300,
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_provinsi.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: null, //'Jumlah Penduduk Pengangguran Per ' + nm_title,
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_provinsi,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        // useHTML: true
                    }
                },
                yAxis: {
                    min: 0,
                    // title: {
                    //     text: 'Populasi',
                    //     align: 'high'
                    // },
                    labels: {
                        overflow: 'justify'
                    },
                    gridLineColor: '#b6b8cc'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    },

                },
                credits: {
                    enabled: false
                },
                // accessibility: {
                //     point: {
                //         valueSuffix: '%'
                //     }
                // },
                tooltip: {
                    pointFormatter: function () {
                        // valueDecimals: 2,
                        point = this,
                            series = point.series;
                        return `${series.name}: <b>${point.y}</b><br/>`
                    },
                    valueSuffix: ' ',
                    shared: true
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                series: [{

                    name: nm_title,
                    data: pengeluaran_ok,
                    borderWidth: 0,
                    dataLabels: {
                        format: '{y}',
                    },
                    // borderColor: 'black',
                    valueDecimals: 2,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    },
                    // color: '#0034b5'
                }]
            });
        }
    });
}
function getDataChartPengeluaranPerkapitaProv(token_csrf, url, nm_title, id_prov) {
    var id_kategori = 2;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            id_kategori: id_kategori,
            id_prov: id_prov,
            _token: token_csrf
        },
        dataType: 'json',
        success: function (response) {

            var nm_provinsi = [];
            var pengeluaran_ok = [];
            $.each(response, function (key, value) {

                nm_provinsi[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                pengeluaran_ok[key] = rupiah(value.pengeluaran)
            })
            // console.log(nm_partai);
            // console.log('----');
            // console.log(pengeluaran_ok);
            Highcharts.chart('perkapita_chart', {
                chart: {
                    type: 'bar',
                    // height: 1300,
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_provinsi.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: null, //'Jumlah Penduduk Pengangguran Per ' + nm_title,
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_provinsi,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        // useHTML: true
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Populasi',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    },
                    gridLineColor: '#b6b8cc'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    },

                },
                credits: {
                    enabled: false
                },
                // accessibility: {
                //     point: {
                //         valueSuffix: '%'
                //     }
                // },
                tooltip: {
                    pointFormatter: function () {
                        valueDecimals: 2,
                            point = this,
                            series = point.series;
                        return `${series.name}: <b>${point.y}</b><br/>`
                    },
                    valueSuffix: ' ',
                    shared: true
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                series: [{

                    name: nm_title,
                    data: pengeluaran_ok,
                    borderWidth: 0,
                    dataLabels: {
                        format: '{y}',
                    },
                    // borderColor: 'black',
                    valueDecimals: 2,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    },
                    // color: '#0034b5'
                }]
            });
        }
    });
}


function getDataPendapatanPerkapitaChart(token_csrf, url, nm_title, limit) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            limit: limit,
            _token: token_csrf
        },
        dataType: 'json',
        success: function (response) {

            var nm_provinsi = [];
            var pengeluaran_ok = [];
            $.each(response, function (key, value) {

                nm_provinsi[key] = value.nm_provinsi
            })
            $.each(response, function (key, value) {
                const rupiah_okok = rupiah(value.pendapatan)
                const rupiah_ok = rupiah_okok.replace('Rp', '')
                pengeluaran_ok[key] =  parseFloat(rupiah_okok)
                // pengeluaran_ok[key] = rupiah(value.pengeluaran)
                // console.log(rupiah_okok);
            })
            console.log(nm_provinsi);
            // console.log('----');
            // console.log(pengeluaran_ok);
            Highcharts.chart('pendapatan_perkapita_chart', {
                chart: {
                    type: 'bar',
                    // height: 1300,
                    backgroundColor: '#0d1623', //0d1623
                    events: {
                        load: function () {
                            let categoryHeight = 40 * nm_provinsi.length;
                            let total_height = categoryHeight;
                            if (total_height <= 250) {
                                categoryHeight = 500;
                            }
                            this.update({
                                chart: {
                                    height: categoryHeight
                                }
                            })
                        }
                    },
                },
                title: {
                    text: null, //'Jumlah Penduduk Pengangguran Per ' + nm_title,
                    align: 'center',
                    style: {
                        color: '#9193a6',
                        // fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: nm_provinsi,
                    title: {
                        text: null,
                    },
                    labels: {
                        style: {
                            fontWeight: 'bold',
                            color: '#9193a6',
                        },
                        // useHTML: true
                    }
                },
                yAxis: {
                    min: 0,
                    // title: {
                    //     text: 'Populasi',
                    //     align: 'high'
                    // },
                    labels: {
                        overflow: 'justify'
                    },
                    gridLineColor: '#b6b8cc'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    },

                },
                credits: {
                    enabled: false
                },
                // accessibility: {
                //     point: {
                //         valueSuffix: '%'
                //     }
                // },
                tooltip: {
                    pointFormatter: function () {
                        // valueDecimals: 2,
                        point = this,
                            series = point.series;
                        return `${series.name}: <b>${point.y}</b><br/>`
                    },
                    valueSuffix: ' ',
                    shared: true
                },
                legend: {
                    itemStyle: {
                        color: '#9899a6',
                        fontWeight: 'bold'
                    }
                },
                series: [{

                    name: nm_title,
                    data: pengeluaran_ok,
                    borderWidth: 0,
                    dataLabels: {
                        format: '{y}',
                    },
                    // borderColor: 'black',
                    valueDecimals: 2,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 0.9
                        },
                        stops: [

                            [0, '#006cb5'],
                            [1, '#0034b5'],
                        ]
                    },
                    // color: '#0034b5'
                }]
            });
        }
    });
}

function grafik_media_line(token_csrf, url, sid) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            sid: sid,
            _token: token_csrf
        },
        dataType: 'json',
        success: function(response) {
            // console.log(response[0].positive);
            var tgl = [];
            var positive = [];
            var negative = [];
            var netral = [];

            $.each(response, function(key, value) {
                tgl.push(value.tgl);
            })
            $.each(response, function(key, value) {
                positive.push(value.positive);
            })
            $.each(response, function(key, value) {
                negative.push(value.negative);
            })
            $.each(response, function(key, value) {
                netral.push(value.netral);
            })

            Highcharts.chart('container', {
                chart: {

                    backgroundColor: '#0d1623', //0d1623
                },
                title: {
                    text: null,
                    align: 'left'
                },

                subtitle: {
                    text: null,
                    align: 'left'
                },

                // yAxis: {
                //     title: {
                //         text: 'Number of Employees'
                //     }
                // },

                xAxis: {
                    categories: tgl,

                    labels: {
                        style: {
                            // fontWeight: 'bold',
                            color: '#9899aa',
                        }
                    }
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    itemStyle: {
                        color: '#9899aa' // Ganti dengan warna yang diinginkan
                    }
                },

                credits: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        // pointStart: 2010
                    }
                },

                series: [{
                    name: 'POSITIVE',
                    data: positive,
                    borderWidth: 0,
                    color: '#0069b5'
                }, {
                    name: 'NETRAL',
                    data: negative,
                    borderWidth: 0,
                    color: '#00b615'
                }, {
                    name: 'NEGATIVE',
                    data: netral,
                    borderWidth: 0,
                    color: '#ff0000'
                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });
        },
        complete: function() {
            // $('#loading-spinner').hide();
            // $('#lds-facebook').hide();
            // $('#lds-facebook-media').hide();
        }
    })
}



function grafik_media_pie(token_csrf, url, sid) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            sid: sid,
            _token: token_csrf
        },
        dataType: 'json',
        success: function(response) {
            console.log(response[0].positive);

            Highcharts.chart('grafik_pie', {
                chart: {
                    type: 'pie',
                    backgroundColor: '#0d1623', //0d1623
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: null,
                    align: 'left'
                },
                subtitle: {
                    text: null,
                    align: 'left'
                },
                // accessibility: {
                //     point: {
                //         valueSuffix: '%'
                //     }
                // },
                // tooltip: {
                //     pointFormat: '{series.name}: <b>{point}</b>'
                // },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    type: 'pie',
                    name: 'Jumlah',
                    data: [{
                        name: 'Positive',
                        y: response[0].positive,
                        borderWidth: 0,
                        color: '#0069b5'
                        // sliced: true,
                        // selected: true
                    }, {
                        name: 'Negative',
                        y: response[0].negative,
                        borderWidth: 0,
                        color: '#ff0000'
                    }, {
                        name: 'Netral',
                        y: response[0].netral,
                        borderWidth: 0,
                        color: '#00b615'
                    }]
                }]
            });
        },
        complete: function() {
            // $('#loading-spinner').hide();
            // $('#lds-facebook').hide();
            // $('#lds-facebook-media').hide();
        }
    });
}



function grafik_media_bar(token_csrf, url, sid) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            sid: sid,
            _token: token_csrf
        },
        dataType: 'json',
        success: function(response) {
            // console.log(response[0].positive);
            var tgl = [];
            var positive = [];
            var negative = [];
            var netral = [];

            $.each(response, function(key, value) {
                tgl.push(value.source);
            })
            $.each(response, function(key, value) {
                positive.push(value.positive);
            })
            $.each(response, function(key, value) {
                negative.push(value.negative);
            })
            $.each(response, function(key, value) {
                netral.push(value.netral);
            })
            Highcharts.chart('container3', {
                chart: {
                    type: 'column',
                    backgroundColor: '#0d1623', //0d1623
                },
                title: {
                    text: null,
                    align: 'left'
                },
                xAxis: {
                    categories: tgl
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: null
                    },
                    stackLabels: {
                        enabled: true
                    }
                },
                legend: {
                    align: 'center',

                    verticalAlign: 'bottom',

                    floating: false,
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor ||
                        'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'POSITIVE',
                    data: positive,
                    borderWidth: 0,
                    color: '#0069b5'
                }, {
                    name: 'NETRAL',
                    data: negative,
                    borderWidth: 0,
                    color: '#00b615'
                }, {
                    name: 'NEGATIVE',
                    data: netral,
                    borderWidth: 0,
                    color: '#ff0000'
                }]
            });
        },
        complete: function() {
            // $('#loading-spinner').hide();
            // $('#lds-facebook').hide();
            // $('#lds-facebook-media').hide();
        }
    })

}
function newsblog(token, url, nm_title, sid, stopWords) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            sid: sid,
            _token: token
        },
        dataType: 'json',
        success: function(response) {
            // console.log('respone : ' + response);

            const newsblogsText = response;
            const newsblogsLines = newsblogsText.replace(/[():'?0-9]+/g, '').split(/[,\. ]+/g);

            const newsblogsData = newsblogsLines.reduce((arr, word) => {
                let cleanedWord = word.toLowerCase();
                // console.log(cleanedWord);
                // if (stopWords && !stopWords.includes(cleanedWord)) {
                let obj = arr.find(obj => obj[0] ===
                    cleanedWord
                ); // Menggunakan indeks 0 sebagai kata dan indeks 1 sebagai bobot
                if (obj) {
                    obj[1] += 1;
                } else {
                    obj = [cleanedWord,
                        1
                    ]; // Menggunakan array dengan indeks 0 sebagai kata dan indeks 1 sebagai bobot
                    arr.push(obj);
                }
                // }
                return arr;
            }, []);

            // console.log(newsblogsLines);
            Highcharts.chart('container_newsblogs', {
                accessibility: {
                    screenReaderSection: {
                        beforeChartFormat: '<h5>{chartTitle}</h5>' +
                            '<div>{chartSubtitle}</div>' +
                            '<div>{chartLongdesc}</div>' +
                            '<div>{viewTableButton}</div>'
                    }
                },
                chart: {
                    backgroundColor: null,
                },
                series: [{
                    type: 'wordcloud',
                    data: newsblogsData,
                    name: 'Occurrences',
                }],
                credits: {
                    enabled: false
                },
                title: {
                    text: null,
                    align: 'left'
                },
                subtitle: {
                    text: null,
                    align: 'left'
                },
                tooltip: {
                    headerFormat: '<span style="font-size: 20px"><b>{point.key}</b></span><br>'
                }
            });

        }
    });
}

function video(token, url, nm_title, sid, stopWords) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            sid: sid,
            _token: token
        },
        dataType: 'json',
        success: function(response) {
            // console.log('respone : ' + response);

            const newsblogsText = response;
            const newsblogsLines = newsblogsText.replace(/[():'?0-9]+/g, '').split(/[,\. ]+/g);

            const newsblogsData = newsblogsLines.reduce((arr, word) => {
                let cleanedWord = word.toLowerCase();
                // console.log("video " + response);
                if (stopWords && !stopWords.includes(cleanedWord)) {
                    // if (!stopWords.includes(cleanedWord)) {
                    let obj = arr.find(obj => obj[0] ===
                        cleanedWord
                    ); // Menggunakan indeks 0 sebagai kata dan indeks 1 sebagai bobot
                    if (obj) {
                        obj[1] += 1;
                    } else {
                        obj = [cleanedWord,
                            1
                        ]; // Menggunakan array dengan indeks 0 sebagai kata dan indeks 1 sebagai bobot
                        arr.push(obj);
                    }
                }
                return arr;
            }, []);

            // console.log(newsblogsData);
            Highcharts.chart('container_video', {
                accessibility: {
                    screenReaderSection: {
                        beforeChartFormat: '<h5>{chartTitle}</h5>' +
                            '<div>{chartSubtitle}</div>' +
                            '<div>{chartLongdesc}</div>' +
                            '<div>{viewTableButton}</div>'
                    }
                },
                chart: {
                    backgroundColor: null,
                },
                series: [{
                    type: 'wordcloud',
                    data: newsblogsData,
                    name: 'Occurrences',
                }],
                credits: {
                    enabled: false
                },
                title: {
                    text: null,
                    align: 'left'
                },
                subtitle: {
                    text: null,
                    align: 'left'
                },
                tooltip: {
                    headerFormat: '<span style="font-size: 20px"><b>{point.key}</b></span><br>'
                }
            });

        }
    });
}

function twitter(token, url, nm_title, sid, stopWords) {
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            sid: sid,
            _token: token
        },
        dataType: 'json',
        success: function(response) {
            // console.log('respone : ' + response);

            const newsblogsText = response;
            const newsblogsLines = newsblogsText.replace(/[():'?0-9]+/g, '').split(/[,\. ]+/g);

            const newsblogsData = newsblogsLines.reduce((arr, word) => {
                let cleanedWord = word.toLowerCase();
                // console.log(cleanedWord);
                // if (stopWords && !stopWords.includes(cleanedWord)) {
                let obj = arr.find(obj => obj[0] ===
                    cleanedWord
                ); // Menggunakan indeks 0 sebagai kata dan indeks 1 sebagai bobot
                if (obj) {
                    obj[1] += 1;
                } else {
                    obj = [cleanedWord,
                        1
                    ]; // Menggunakan array dengan indeks 0 sebagai kata dan indeks 1 sebagai bobot
                    arr.push(obj);
                }
                // }
                return arr;
            }, []);

            // console.log(newsblogsLines);
            Highcharts.chart('container_twitter', {
                accessibility: {
                    screenReaderSection: {
                        beforeChartFormat: '<h5>{chartTitle}</h5>' +
                            '<div>{chartSubtitle}</div>' +
                            '<div>{chartLongdesc}</div>' +
                            '<div>{viewTableButton}</div>'
                    }
                },
                chart: {
                    backgroundColor: null,
                },
                series: [{
                    type: 'wordcloud',
                    data: newsblogsData,
                    name: 'Occurrences',
                }],
                credits: {
                    enabled: false
                },
                title: {
                    text: null,
                    align: 'left'
                },
                subtitle: {
                    text: null,
                    align: 'left'
                },
                tooltip: {
                    headerFormat: '<span style="font-size: 20px"><b>{point.key}</b></span><br>'
                }
            });

        }
    });
}
function chartbar(token, url, nm_title, sid) {
    const stopWords = ['ANIES', 'PRABOWO', 'GANJAR']
    var id_kategori = 1;
    $.ajax({
        url: url,
        type: 'post',
        data: {
            sid: sid,
            _token: token
        },
        dataType: 'json',
        success: function (response) {
            // console.log('respone : ' + response);

            const newsblogsText = response;
            const newsblogsLines = newsblogsText.replace(/[():'?0-9]+/g, '').split(/[,\. ]+/g);

            const newsblogsData = newsblogsLines.reduce((arr, word) => {
                let cleanedWord = word.toUpperCase();

                if (stopWords && stopWords.includes(cleanedWord)) {
                    let obj = arr.find(obj => obj[0] ===
                        cleanedWord
                    ); // Menggunakan indeks 0 sebagai kata dan indeks 1 sebagai bobot
                    if (obj) {
                        obj[1] += 1;
                    } else {
                        obj = [cleanedWord,
                            1
                        ]; // Menggunakan array dengan indeks 0 sebagai kata dan indeks 1 sebagai bobot
                        arr.push(obj);
                    }
                }
                return arr;
            }, []);
            // console.log(newsblogsData);


            // console.log(result);
            // console.log(newsblogsLines);
            Highcharts.chart('container_bar', {
                chart: {
                    type: 'column',
                    backgroundColor: '#0d1623', //0d1623
                },
                title: {
                    text: null
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '14px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Popularitas'
                    }
                },
                credits: {
                    enabled: false
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Popularitas<b>{point.y}</b>'
                },
                series: [{
                    borderWidth: 0,
                    borderColor: 'black',
                    name: 'Popularitas',
                    colors: [
                        '#0B24F7', '#FF0000', '#FFFFFF'
                    ],
                    colorByPoint: true,
                    groupPadding: 0,
                    data: newsblogsData,
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });

        }
    });
}
function AnalisisSentiment(token_csrf, url, sid) {
    $.ajax({
        url: url,
        type: 'post',
        data: {
            sid: sid,
            _token: token_csrf
        },
        dataType: 'json',
        success: function(response) {
            // console.log(response[0].positive);
            var tgl = [];
            var positive = [];
            var negative = [];
            var netral = [];

            $.each(response, function(key, value) {
                tgl.push(value.source);
            })
            $.each(response, function(key, value) {
                positive.push(value.positive);
            })
            $.each(response, function(key, value) {
                negative.push(value.negative);
            })
            $.each(response, function(key, value) {
                netral.push(value.netral);
            })
            Highcharts.chart('analisis_sentiment', {
                chart: {
                    type: 'column',
                    backgroundColor: '#0d1623', //0d1623
                },
                title: {
                    text: null,
                    align: 'left'
                },
                xAxis: {
                    categories: tgl
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: null
                    },
                    stackLabels: {
                        enabled: true
                    }
                },
                legend: {
                    align: 'center',

                    verticalAlign: 'bottom',

                    floating: false,
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor ||
                        'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'POSITIVE',
                    data: positive,
                    borderWidth: 0,
                    color: '#0069b5'
                }, {
                    name: 'NETRAL',
                    data: negative,
                    borderWidth: 0,
                    color: '#00b615'
                }, {
                    name: 'NEGATIVE',
                    data: netral,
                    borderWidth: 0,
                    color: '#ff0000'
                }]
            });
        },
        complete: function() {
            // $('#loading-spinner').hide();
            // $('#lds-facebook').hide();
            // $('#lds-facebook-media').hide();
        }
    })

}
