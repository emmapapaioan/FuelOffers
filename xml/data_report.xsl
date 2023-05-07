<?xml version='1.0' encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method = "html"></xsl:output>
<xsl:template match="/">
    <html>
        <head>
        <script src="../js/functions.js"></script>
        </head>
        <body style="font-family:Arial; font-size:18px; margin:25px;">
        <div style="display: flex; flex-direction:column; flex-wrap: wrap; justify-content: space-between; width: 90%; margin: 0 auto;">
            <xsl:call-template name="company-data"/>
            <xsl:call-template name="offers-table"/>
            <xsl:call-template name="daily-prices"/>
        </div>
        </body>
    </html>
</xsl:template>

<!-- XSL Template for the company data -->
<xsl:template name="company-data">
    <div style="width:max-content; box-sizing: border-box;">
        <h1>Στοιχεία εταιρείας</h1>
        <p><strong>Επωνυμία: </strong><xsl:value-of select="data_report/user_data/name"/></p>
        <p><strong>ΑΦΜ: </strong><xsl:value-of select="data_report/user_data/vat"/></p>
        <p><strong>Διεύθυνση: </strong><xsl:value-of select="data_report/user_data/address"/>, 
        Νομός <xsl:value-of select="data_report/user_data/prefecture"/>, 
        Δήμος <xsl:value-of select="data_report/user_data/municipality"/></p>
        <p><strong>Συνολικός αριθμός προσφορών: </strong><xsl:value-of select="count(//offer)"/></p>
    </div>
</xsl:template>

<!-- XSL Template for the offers table -->
<xsl:template name="offers-table">
<div style="width:max-content; box-sizing: border-box;">
    <h1>Προσφορές υγρών καυσίμων</h1>
    <table border="1px" style="margin-left:auto; margin-right:auto; border:1.2px solid black; font-size:18px; border-collapse: collapse; cellpadding: auto; cellspacing: 5px; width: 100%;">
        <tr bgcolor="teal">
            <th>Είδος Καυσίμου</th>
            <th>Τιμή</th>
            <th>Ημ/νία Λήξης</th>
            <th>Κατάσταση</th>
        </tr>
        <xsl:for-each select="data_report/offers/*">
        <tr style="text-align:center;">
            <td><xsl:value-of select="fuel_type"/></td>
            <td><xsl:value-of select="price"/></td>
            <td><xsl:value-of select="expiring_date"/></td>
            <td><xsl:choose>
                <xsl:when test="active = 'True'">Ενεργή</xsl:when>
                <xsl:otherwise>Ανενεργή</xsl:otherwise>
            </xsl:choose></td>
        </tr>
        </xsl:for-each>
    </table>
</div>
</xsl:template>

<!-- XSL Template for the daily min/max/avg prices -->
<xsl:template name="daily-prices">
<div style="width:max-content; box-sizing: border-box;">
<h1>Ημερήσια σύνοψη τιμών</h1>
<!--Current date-->
<div id="current-date">
        <script>
            getCurrentDate();
        </script>
</div>
<!--List of prices-->
<ul id="price-list" title="Ημερήσια σύνοψη τιμών" style="list-style-type: none; padding: 0;">
    <xsl:variable name="fuelPrices" select="/data_report/offers/offer" />
    <xsl:for-each select="$fuelPrices">
        <li style="padding-bottom: 2px;">
            <strong><xsl:value-of select="fuel_type" /></strong>
            <p>
                <xsl:choose>
                    <xsl:when test="price = 0">
                        <div id="no-prices">*Δεν υπάρχουν ενεργές προσφορές για την τρέχουσα ημερομηνία.</div>
                    </xsl:when>
                    <xsl:otherwise>
                        Μέγιστη:<xsl:value-of select="price" />
                        /Ελάχιστη:<xsl:value-of select="price" />
                        /Μέση:<xsl:value-of select="price" />
                    </xsl:otherwise>
                </xsl:choose>
            </p>
        </li>
    </xsl:for-each>
    <xsl:if test="not($fuelPrices)">
        <li>
            <h2><i>Δεν υπάρχουν διαθέσιμες τιμές</i></h2>
        </li>
    </xsl:if>
</ul>
</div>
</xsl:template>

</xsl:stylesheet>

