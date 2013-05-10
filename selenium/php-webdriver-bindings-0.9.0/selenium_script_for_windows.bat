REM Run this on the windows internet explorer machine after installing ssh
ssh -fNT -L 8080:localhost:8080 ryant@ryan.nanofab.utah.edu
ssh -fNT -R 4444:localhost:4444 ryant@ryan.nanofab.utah.edu
java -jar selenium-server-standalone-2.25.0.jar
