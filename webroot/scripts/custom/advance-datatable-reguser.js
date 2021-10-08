var TableAdvanced = function () {

    var initTable1 = function() {

        /* Formatting function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table class="table table-bordered">';
            sOut += '<tr><th>Reg. Id:</th><td>'+aData[1]+'</td><th>Name:</th><td>'+aData[2]+'</td></tr>';
            sOut += '<tr><th>Order Id:</th><td>'+aData[31]+'</td><th>PayDate(s):</th><td>'+aData[9]+'</td></tr>';
            sOut += '<tr><th>ID Proof:</th><td>'+aData[32]+'</td><th>ID Proof No.:</th><td>'+aData[33]+'</td></tr>';
            sOut += '<tr><th>Father Name:</th><td>'+aData[10]+'</td><th>Mother Name:</th><td>'+aData[11]+'</td></tr>';
            sOut += '<tr><th>Gender:</th><td>'+aData[12]+'</td><th>Community:</th><td>'+aData[13]+'</td></tr>';
            sOut += '<tr><th>DOB:</th><td>'+aData[14]+'</td><th>Email:</th><td>'+aData[15]+'</td></tr>';
            sOut += '<tr><th>Mobile No.1:</th><td>'+aData[16]+'</td><th>Mobile No.2:</th><td>'+aData[17]+'</td></tr>';
            sOut += '<tr><th>State:</th><td>'+aData[18]+'</td><th>Division:</th><td>'+aData[19]+'</td></tr>';
            sOut += '<tr><th>District:</th><td>'+aData[20]+'</td><th>Address:</th><td>'+aData[21]+'</td></tr>';
            sOut += '<tr><th>Pincode:</th><td>'+aData[22]+'</td><th>Job Title:</th><td>'+aData[23]+'</td></tr>';
            sOut += '<tr><th>Qulification.:</th><td>'+aData[24]+'</td><th>Job Location:</th><td>'+aData[25]+'</td></tr>';
            sOut += '<tr><th>PG:</th><td>'+aData[26]+'</td><th>UG:</th><td>'+aData[27]+'</td></tr>';
            sOut += '<tr><th>12<sup>th</sup>:</th><td>'+aData[28]+'</td><th>10<sup>th</sup>:</th><td>'+aData[29]+'</td></tr>';
            sOut += '<tr><th>Other:</th><td>'+aData[30]+'</td><th>Physical:</th><td>'+aData[34]+'</td></tr>';
            sOut += '</table>';
             
            return sOut;
        }

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
         
        $('#table11 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#table11 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialize DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#table11').dataTable( {
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
             "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
        });

        //jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-small input-inline"); // modify table search input
        //jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
        //jQuery('#sample_1_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#table11').on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */                
                $(this).addClass("row-details-open").removeClass("row-details-close");
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
        }

    };

}();