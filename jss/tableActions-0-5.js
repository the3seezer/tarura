/*
        Table actions plug-in v0.5 by frequency-decoder.com

        Released under a creative commons Attribution-ShareAlike 2.5 license (http://creativecommons.org/licenses/by-sa/2.5/)

        Please credit frequency decoder in any derivative work - thanks

        You are free:

        * to copy, distribute, display, and perform the work
        * to make derivative works
        * to make commercial use of the work

        Under the following conditions:

                by Attribution.
                --------------
                You must attribute the work in the manner specified by the author or licensor.

                sa
                --
                Share Alike. If you alter, transform, or build upon this work, you may distribute the resulting work only under a license identical to this one.

        * For any reuse or distribution, you must make clear to others the license terms of this work.
        * Any of these conditions can be waived if you get permission from the copyright holder.

        NOTE: Parts of this script is based on a script originally developped by the veritable Richard Cornford (http://www.litotes.demon.co.uk/example_scripts/tableHighlighter.html)
*/

var fdTableActions = {
        tableCache:{},
        init:function() {
                var tables = document.getElementsByTagName("table");
                var rowAlt, colHover, rowHover, rowSelect, rowSelectCallback, cellHover, rowList, rowArr, colObj, elem, rowLength, workArr, celCount, rowSpan, colSpan, cel, colHead, rowL, colL;
                var uniqueID = 0;
                var colspan = "colspan";
                var rowspan = "rowspan";
                /*@cc_on
                /*@if(@_win32)
                colspan = "colSpan";
                rowspan = "rowSpan";
                /*@end
                @*/

                for(var k = 0, table; table = tables[k]; k++) {
                        // Grab the className for the alternate rows
                        rowAlt  = table.className.search(/rowstylealt-([\S-]+)/) == -1 ? "" : table.className.match(/rowstylealt-([\S]+)/)[1];
                        // Highlight columns?
                        colHover  = table.className.search(/colstylehover-([\S-]+)/) == -1 ? "" : table.className.match(/colstylehover-([\S]+)/)[1];
                        // Grab the className for the rowStyleHover
                        rowHover  = table.className.search(/rowstylehover-([\S-]+)/) == -1 ? "" : table.className.match(/rowstylehover-([\S]+)/)[1];
                        // Do we select the rows
                        rowSelect = table.className.search(/rowselect-([\S-]+)/) == -1 ? "" : table.className.match(/rowselect-([\S]+)/)[1];
                        // Single or multiple row selection possible
                        rowSelectSingle = table.className.search(/rowselectsingle/) != -1;
                        // Do we have a callback for this table whenever a row is selected?
                        rowSelectCallback = table.className.search(/rowselectcallback-([\S-]+)/) == -1 ? "" : table.className.match(/rowselectcallback-([\S]+)/)[1];
                        // Replace "-" with "." to enable Object.method callbacks
                        rowSelectCallback = rowSelectCallback.replace("-", ".");
                        // Current TH or TD
                        cellHover = table.className.search(/cellhover-([\S-]+)/) == -1 ? "" : table.className.match(/cellhover-([\S]+)/)[1];

                        // Do we even need to continue?
                        if(!(rowAlt && rowHover && colHover && rowSelect && cellHover)) continue;

                        // Create a table ID if necessary
                        if(!table.id) table.id = "fdTable-" + uniqueID++;

                        // Cache this tables details
                        fdTableActions.tableCache[table.id] = { "trCache":[], "rowSelectSingle":rowSelectSingle, "rowSelect":rowSelect, "rowSelectCallback":rowSelectCallback, "lastColCache":[0,0], "rowHover":rowHover, "colHover":colHover };

                        /*@cc_on
                        @if (@_jscript_version >= 5.7)
                                if(document.compatMode == "BackCompat") fdTableActions.tableCache[table.id].req = true;
                        @else
                                fdTableActions.tableCache[table.id].req = true;
                        @end
                        @*/

                        /*@cc_on
                        /*@if(@_win32)
                        if(fdTableActions.tableCache[table.id].req) {
                                fdTableActions.tableCache[table.id].lastRow   = null;
                                fdTableActions.tableCache[table.id].lastCell  = null;
                                fdTableActions.tableCache[table.id].cellHover = cellHover;
                        };
                        /*@end
                        @*/
                        rowArr = [];
                        rowList = table.getElementsByTagName('tr');

                        for(var i = 0;i < rowList.length;i++){
                                colObj = [];
                                elem = rowList[i].firstChild;
                                do {
                                        if(elem.tagName && elem.tagName.toLowerCase().search(/td|th/) != -1) {
                                                colObj[colObj.length] = elem;
                                        };
                                        elem = elem.nextSibling;
                                } while(elem);
                                if(i % 2 == 0 && rowAlt) rowList[i].className = rowList[i].className + " " + rowAlt;
                                rowArr[rowArr.length] = colObj;
                        };

                        /*@cc_on
                        /*@if (@_win32)
                        if(fdTableActions.tableCache[table.id].req) {
                                if(!cellHover && !rowSelect && !colHover && !rowHover) continue;
                        } else {
                                if(!colHover && !rowSelect) continue;
                        };
                        @else @*/
                        if(!colHover && !rowSelect) continue;
                        /*@end
                        @*/

                        if(rowArr.length > 0){
                                /* Attribution: Parts of the following code based on an original script by Richard Cornford (http://www.litotes.demon.co.uk/example_scripts/tableHighlighter.html) */
                                if(colHover) {
                                        rowLength = rowArr[0].length;
                                        for(var c = 0;c < rowArr[0].length;c++){
                                                if(rowArr[0][c].getAttribute(colspan) > 1){
                                                        rowLength = rowLength + (rowArr[0][c].getAttribute(colspan) - 1);
                                                };
                                        };

                                        workArr  = new Array(rowArr.length);
                                        for(var c = rowArr.length;c--;){
                                                workArr[c]  = new Array(rowLength);
                                        };

                                        colHead = new Array(rowLength);
                                        for(var c = rowLength;c--;){
                                                colHead[c]  = [];
                                        };

                                        for(var c = 0;c < workArr.length;c++) {
                                                celCount = 0;
                                                for(var i = 0;i < rowLength;i++) {
                                                        if(!workArr[c][i]) {
                                                                cel = rowArr[c][celCount];
                                                                colSpan = (cel.getAttribute(colspan) && cel.getAttribute(colspan) > 1) ? cel.getAttribute(colspan) : 1;
                                                                rowSpan = (cel.getAttribute(rowspan) && cel.getAttribute(rowspan) > 1) ? cel.getAttribute(rowspan) : 1;
                                                                cel.className = cel.className + " fdCellProcessed-" + i + "-" + (i + Number(colSpan));
                                                                for(var t = 0;((t < colSpan)&&((i+t) < rowLength));t++){
                                                                        for(var n = 0;((n < rowSpan)&&((c+n) < workArr.length));n++){
                                                                                workArr[(c+n)][(i+t)] = cel;
                                                                        };
                                                                        colHead[(i+t)][colHead[(i+t)].length] = cel;
                                                                };
                                                                if(++celCount == rowArr[c].length) break;
                                                        };
                                                };
                                        };
                                        /* End attribution */
                                        fdTableActions.tableCache[table.id].colCache = colHead;
                                };

                                fdTableActions.addEvent(table, "mouseover", fdTableActions.tableEvent);
                                fdTableActions.addEvent(table, "mouseout",  fdTableActions.tableEvent);

                                if(rowSelect) {
                                        fdTableActions.addEvent(table, "click",  fdTableActions.clickEvent);
                                };
                        };
                };
        },
        clickEvent:function(e) {
                e = e || window.event;
                var tr, cell;
                if(e.target) tr = e.target;
                else if (e.srcElement) tr = e.srcElement;

                while(true) {
                        if(tr && !cell && tr.nodeName && tr.nodeName.search(/^(TD|TH)$/) != -1) { cell = tr; }
                        else if(tr && tr.nodeName && tr.nodeName.search(/^(TR)$/) != -1) { break; };
                        try { tr = tr.parentNode; } catch(err) { break; };
                };

                if(!tr.nodeName || tr.nodeName.search(/^(TR)$/) == -1) { return; };

                var remove = (tr.className.search(fdTableActions.tableCache[this.id].rowSelect) != -1);
                var action = true;

                if(fdTableActions.tableCache[this.id].rowSelectCallback) {
                        var func;
                        if(fdTableActions.tableCache[this.id].rowSelectCallback.search(".") != -1) {
                                var split = fdTableActions.tableCache[this.id].rowSelectCallback.split(".");
                                func = window;
                                for(var i = 0, f; f = split[i]; i++) {
                                        if(f in func) {
                                                func = func[f];
                                        } else { break; };
                                };
                        } else if(fdTableActions.tableCache[this.id].rowSelectCallback in window) {
                                func = window[fdTableActions.tableCache[this.id].rowSelectCallback];
                        } else if("rowSelectCallback" in window) {
                                func = window["rowSelectCallback"];
                        };
                        if(typeof func == "function") {
                                action = func({"table":this, "cell":cell, "row":tr, "remove":remove, "rows":fdTableActions.tableCache[this.id].trCache.concat([])});
                        };
                        func = null;
                };

                if(action) {
                        if(remove) {
                                tr.className = tr.className.replace(fdTableActions.tableCache[this.id].rowSelect, "");
                                var rowArr = [];
                                for(var i = 0, elem; elem = fdTableActions.tableCache[this.id].trCache[i]; i++) {
                                        if(elem != tr) rowArr[rowArr.length] = elem;
                                };
                                fdTableActions.tableCache[this.id].trCache = rowArr;
                        } else {
                                tr.className = tr.className + " " + fdTableActions.tableCache[this.id].rowSelect;
                                if(fdTableActions.tableCache[this.id].rowSelectSingle && fdTableActions.tableCache[this.id].trCache.length) {
                                        fdTableActions.tableCache[this.id].trCache[0].className = fdTableActions.tableCache[this.id].trCache[0].className.replace(fdTableActions.tableCache[this.id].rowSelect, "");
                                        fdTableActions.tableCache[this.id].trCache = [];
                                };
                                fdTableActions.tableCache[this.id].trCache[fdTableActions.tableCache[this.id].trCache.length] = tr;
                        };
                };
        },
        tableEvent:function(e) {
                e = e || window.event;
                var p;
                if(e.type == "mouseout") {
                        p = e.toElement || e.relatedTarget;
                } else {
                        p = e.target || e.srcElement;
                        if (p.nodeType && p.nodeType == 3) p = p.parentNode;
                };

                while(true) {
                        if(p && p.nodeName && p.nodeName.search(/^(TD|TH)$/) != -1) { break; };
                        try { p = p.parentNode; } catch(err) { break; };
                };

                // Get the old column range
                var colRangeOld = fdTableActions.tableCache[this.id].lastColCache;
                var r = [];
                var n = [];

                if(p && p.nodeName.search(/^(TD|TH)$/) != -1) {
                        // Do current cell & row for bloody IE
                        /*@cc_on
                        /*@if(@_win32)
                        if(fdTableActions.tableCache[this.id].req) {
                                if(fdTableActions.tableCache[this.id].rowHover) {
                                        var tr = p.parentNode;
                                        if(fdTableActions.tableCache[this.id].lastRow != tr) {
                                                if(fdTableActions.tableCache[this.id].lastRow) {
                                                        fdTableActions.tableCache[this.id].lastRow.className = fdTableActions.tableCache[this.id].lastRow.className.replace(fdTableActions.tableCache[this.id].rowHover,"");
                                                };
                                                tr.className = tr.className + " " + fdTableActions.tableCache[this.id].rowHover;
                                                fdTableActions.tableCache[this.id].lastRow = tr;
                                        };
                                };
                                if(fdTableActions.tableCache[this.id].cellHover) {
                                        if(fdTableActions.tableCache[this.id].lastCell != p) {
                                                if(fdTableActions.tableCache[this.id].lastCell) {
                                                        fdTableActions.tableCache[this.id].lastCell.className = fdTableActions.tableCache[this.id].lastCell.className.replace(fdTableActions.tableCache[this.id].cellHover,"");
                                                };
                                                p.className = p.className + " " + fdTableActions.tableCache[this.id].cellHover;
                                                fdTableActions.tableCache[this.id].lastCell = p;
                                        };
                                };
                        };
                        /*@end
                        @*/
                        if(!fdTableActions.tableCache[this.id].colHover || p.className.search("fdCellProcessed-") == -1) return;
                        var m = p.className.match(/fdCellProcessed-([\d]+)-([\d]+)/);
                        m[1] = Number(m[1]);
                        m[2] = Number(m[2]);
                        if(fdTableActions.tableCache[this.id].lastColCache[0] == m[1] && fdTableActions.tableCache[this.id].lastColCache[1] == m[2]) return;
                        for(var i = colRangeOld[0]; i < colRangeOld[1]; i++) {
                                if(i < m[1] || i >= m[2]) {
                                        r[r.length] = i;
                                };
                        };
                        fdTableActions.tableCache[this.id].lastColCache = [m[1], m[2]];
                        n = [m[1], m[2]];
                } else {
                        /*@cc_on
                        /*@if(@_win32)
                        if(fdTableActions.tableCache[this.id].req) {
                                if(fdTableActions.tableCache[this.id].lastRow) {
                                        fdTableActions.tableCache[this.id].lastRow.className = fdTableActions.tableCache[this.id].lastRow.className.replace(fdTableActions.tableCache[this.id].rowHover,"");
                                        fdTableActions.tableCache[this.id].lastRow = null;
                                };
                                if(fdTableActions.tableCache[this.id].lastCell) {
                                        fdTableActions.tableCache[this.id].lastCell.className = fdTableActions.tableCache[this.id].lastCell.className.replace(fdTableActions.tableCache[this.id].cellHover,"");
                                        fdTableActions.tableCache[this.id].lastCell = null;
                                };
                        };
                        /*@end
                        @*/
                        if(!fdTableActions.tableCache[this.id].colHover) { return; };
                        for(var i = colRangeOld[0]; i <= colRangeOld[1]; i++) {
                                r[r.length] = i;
                        };
                        fdTableActions.tableCache[this.id].lastColCache = [0,0];
                };

                // Remove
                if(e.type == "mouseout" && r.length) {
                        for(var i = 0; i < r.length; i++) {
                                if(r[i] >= fdTableActions.tableCache[this.id].colCache.length) continue;
                                elemArr = fdTableActions.tableCache[this.id].colCache[r[i]];
                                for(var ec = 0, elem; elem = elemArr[ec]; ec++) {
                                        elem.className = elem.className.replace(fdTableActions.tableCache[this.id].colHover, "");
                                };
                        };
                };

                // Add
                if(n.length) {
                        for(i = n[0]; i < n[1]; i++) {
                                elemArr = fdTableActions.tableCache[this.id].colCache[i];
                                for(var ec = 0, elem; elem = elemArr[ec]; ec++) {
                                        if(elem.className.search(fdTableActions.tableCache[this.id].colHover) == -1) {
                                                elem.className = elem.className + " " + fdTableActions.tableCache[this.id].colHover;
                                        };
                                };
                        };
                };
        },
        deselectAllRows:function(tableId) {
                if(!(tableId in fdTableActions.tableCache) || !fdTableActions.tableCache[tableId].rowSelect) return;
                var trList = fdTableActions.tableCache[tableId].trCache;
                for(var i = trList.length; i--;) {
                        trList[i].className = trList[i].className.replace(fdTableActions.tableCache[tableId].rowSelect, "");
                };
                fdTableActions.tableCache[tableId].trCache = [];
                trList = null;
        },
        unLoad:function() {
                var table;
                for(tbl in fdTableActions.tableCache) {
                        table = document.getElementById(tbl);
                        if(table) {
                                fdTableActions.removeEvent(table, "mouseover", fdTableActions.tableEvent);
                                fdTableActions.removeEvent(table, "mouseout",  fdTableActions.tableEvent);
                                if(fdTableActions.tableCache[tbl].rowSelect) {
                                        fdTableActions.removeEvent(table, "click",  fdTableActions.clickEvent);
                                };
                        };
                        /*@cc_on
                        /*@if(@_win32)
                        fdTableActions.tableCache[tbl].req = fdTableActions.tableCache[tbl].lastRow = fdTableActions.tableCache[tbl].lastCell = null;
                        /*@end
                        @*/
                        fdTableActions.tableCache[tbl].colCache = fdTableActions.tableCache[tbl].trCache = null;
                        fdTableActions.tableCache[tbl] = null;
                        delete(fdTableActions.tableCache[tbl]);
                };
        },
        addEvent:function(obj, type, fn) {
                if( obj.attachEvent ) {
                        obj["e"+type+fn] = fn;
                        obj[type+fn] = function(){obj["e"+type+fn]( window.event );};
                        obj.attachEvent( "on"+type, obj[type+fn] );
                } else {
                        obj.addEventListener( type, fn, true );
                };
        },
        removeEvent: function(obj, type, fn) {
                if( obj.detachEvent ) {
                        try {
                                obj.detachEvent( "on"+type, obj[type+fn] );
                                obj[type+fn] = obj["e"+type+fn] = null;
                        } catch(err) {};
                } else {
                        obj.removeEventListener( type, fn, true );
                };
        }
};

fdTableActions.addEvent(window, "load", fdTableActions.init);
fdTableActions.addEvent(window, "unload", fdTableActions.unLoad);

