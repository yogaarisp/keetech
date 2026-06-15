Add-Type -AssemblyName System.Drawing
$url = "https://keetech.my.id/storage/settings/o3TGJ3jMXm1q39V267yDKHcYp5XrWISqvqWPCJ4L.png"
$req = [System.Net.WebRequest]::Create($url)
$res = $req.GetResponse()
$img = [System.Drawing.Image]::FromStream($res.GetResponseStream())
$bmp = New-Object System.Drawing.Bitmap $img
$color = $bmp.GetPixel(0,0)
Write-Host "Color: $($color.R) $($color.G) $($color.B) $($color.A)"
