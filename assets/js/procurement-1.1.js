/** 
 * function to change start date as per the days number
*/
function changeStartDate(currentObj) {
    try {
        var numDays = 0, dateObj,dateObjTarget, curStartDate, revisedStartDate;
        numDays = $(currentObj).val();
        numDays = parseInt(numDays);
        numDays = isNaN(numDays) ? 0 : numDays;
        // Do nothing in case of nothing in days input box
        if ((numDays == '' || numDays == undefined || numDays == null || numDays == 0) && numDays > 0) {
            return false;
        }

        dateObjTarget = $(currentObj).parents('tr').next('tr').find('.'+$(currentObj).attr('target_date_class'));
        dateObj = $(currentObj).parents('td').find('.txt-date');
        if (dateObj != undefined) {
            curStartDate = $(dateObj).val();
            curStartDate = convertDateAsYYYYMMDD(curStartDate);
            if (curStartDate != undefined) {
                revisedStartDate = addNumDaysToDate(curStartDate, numDays);
                revisedStartDate = convertDateToDDMMYYYY(revisedStartDate);
                $(dateObjTarget).val(revisedStartDate);
            }
        }
    }
    catch (ex) {
        console.log(ex);
    }
}

/**
 * add Num Days to given date
 * @param {*} dateValue 
 * @param {*} numDays 
 */
function addNumDaysToDate(dateValue, numDays) {
    var newdate;
    newdate = new Date(dateValue);
    if (dateValue == '' || dateValue == null) {
        return '';
    }
    try {
        newdate = newdate.addDays(numDays);
    }
    catch (ex) {
        newdate = '';
    }
    return newdate;
}

/**
 * add num of days in date
 * @param {*} days 
 */
Date.prototype.addDays = function (days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

/**
 * convertDateAsYYYYMMDD
 * @param {*} dateValue 
 */
function convertDateAsYYYYMMDD(dateValue) {
    var newdate;
    if (dateValue == '' || dateValue == null) {
        return '';
    }
    try {
        var dateObj = dateValue.split('-');
        var month = dateObj[1];


        var day = dateObj[0];

        var year = dateObj[2];

        newdate = year + "-" + month + "-" + day;
    }
    catch (ex) {
        newdate = '';
    }
    return newdate;
}

/**
 * convertDateToDDMMYYYY
 * @param {*} value 
 */
function convertDateToDDMMYYYY(value) {
    var newdate;
    if (value == '' || value == null) {
        return '';
    }
    try {
        var dateObj = new Date(value);
        var month = dateObj.getMonth() + 1;
        if (month < 10) {
            month = "0" + month;
        }

        var day = dateObj.getDate();
        if (day < 10) {
            day = "0" + day;
        }
        var year = dateObj.getFullYear();
        newdate = day + "-" + month + "-" + year;
    }
    catch (ex) {
        newdate = '';
    }
    return newdate;
}

/**
 * filter data of over all project report
 */
function filterOverallProject()
{
    var arrProjectIds=[];
    arrProjectIds=$(".op_proj_select").val();
    window.location.href="/IPE_UP_Project/Procurement/report_overall_project/"+arrProjectIds.join("_");
}

/**
 * filter data of project by stage report
 */
function filterProjectStageReport()
{
    var arrStageIds=[];
    arrStageIds=$(".op_stage_select").val();
    window.location.href="/IPE_UP_Project/Procurement/report_project_stage/"+arrStageIds.join("_");
}