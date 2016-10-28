<html>
    <head>
        <script language="JavaScript">
            DA = (document.all) ? 1 : 0
            function HandleError()
            {
                alert("\error.");
                return true;
            }
        </script>
        <script language="JavaScript">
            function NoDialogBox()
                    //ใช้ปิด window โดยไม่ขึ้น confirm dialog box
                    {
                        window.open('', '_self');
                        self.close();
                    }

        </script>
    </head>
    <body></body>
    <script language="VBScript">
        Sub window_onunload()
                On Error Resume Next
                Set WB = nothing
                On Error Goto 0
                End Sub
                Sub
        Print()
                OLECMDID_PRINT = 6
        OLECMDEXECOPT_DONTPROMPTUSER = 2
        OLECMDEXECOPT_PROMPTUSER = 1
                On Error Resume Next
                If DA Then
                call
        WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, 1)
                Else
                call WB.IOleCommandTarget.Exec(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, "", "", "")
                End If
                If Err.Number < > 0 Then
                If
        DA Then
                Alert("Nothing Printed :" & err.number & " : " & err.description)
        Else
        HandleError()
                End If
                End If
                On Error Goto 0
                End Sub
                If
        DA Then
                wbvers = "8856F961-340A-11D0-A96B-00C04FD705A2"
        Else
        wbvers = "EAB22AC3-30C1-11CF-A7EB-0000C05BAE0B"
                End If
                document.write "<object ID=" "WB" " WIDTH=0 HEIGHT=0 CLASSID=" "CLSID:"
                document.write
        wbvers & """> </object>"
    </script>
</html>