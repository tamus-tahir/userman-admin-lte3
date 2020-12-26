function tanggalIndo($date)
{
$tanggal = explode("-", $date);

switch ($tanggal[1]) {
case "1":
$tanggal[1] = "Januari";
break;
case "2":
$tanggal[1] = "Februari";
break;
case "3":
$tanggal[1] = "Maret";
break;
case "4":
$tanggal[1] = "April";
break;
case "5":
$tanggal[1] = "Mei";
break;
case "6":
$tanggal[1] = "Juni";
break;
case "7":
$tanggal[1] = "Juli";
break;
case "8":
$tanggal[1] = "Agustus";
break;
case "9":
$tanggal[1] = "September";
break;
case "10":
$tanggal[1] = "Oktober";
break;
case "11":
$tanggal[1] = "November";
break;
case "12":
$tanggal[1] = "Desember";
break;
default:
$tanggal[1] = "No Date";
}

$tanggalBaru = $tanggal[2] . ' ' . $tanggal[1] . ' ' . $tanggal[0];
return $tanggalBaru;
}

function niceNumber($n)
{
if ($n <= 0) { return 0; } // first strip any formatting; $n=(0 + str_replace(",", "" , $n)); // is this a number? if (!is_numeric($n)) return false; // now filter it; if ($n> 1000000000000) return round(($n / 1000000000000), 2) . ' T';
    elseif ($n > 1000000000) return round(($n / 1000000000), 2) . ' M';
    elseif ($n > 1000000) return round(($n / 1000000), 2) . ' Jt';
    elseif ($n > 1000) return round(($n / 1000), 2) . ' Ribu';

    return number_format($n);
    }

    function persentase($small, $big, $round)
    {
    if ($small == 0) {
    $persentase = 0;
    } else {
    $persentase = round($small * 100 / $big, $round);
    }

    return $persentase;
    }