# desktop shortcut in desktop linux

##Firefox Developer edition
```
download https://www.mozilla.org/pt-BR/firefox/developer/all/

mv firefox-*.tar.bz2 /opt
cd /opt
tar -xvf firefox-*.tar.bz2 

ln -s /opt/firefox/firefox /usr/local/bin/firefox

### Create desktop shortcut
touch /usr/share/applications/firefox-developer.desktop
nano /usr/share/applications/firefox-developer.desktop

copy and past

[Desktop Entry]
Name=Firefox Developer
GenericName=Firefox Developer Edition
Exec=/usr/local/bin/firefox
Terminal=false
Icon=/opt/firefox/browser/chrome/icons/default/default48.png
Type=Application
Categories=Application;Network;X-Developer;
Comment=Firefox Developer Edition Web Browser

save

chmod +x /usr/share/applications/firefox-developer.desktop
```

## Postman
```
Ref.: post https://linux4one.com/how-to-install-postman-on-fedora-29/

wget https://dl.pstmn.io/download/latest/linux64 -O postman-linux-x64.tar.gz

sudo tar xvzf postman-linux-x64.tar.gz -C /opt

sudo ln -s /opt/Postman/Postman /usr/bin/postman

cat << EOF > ~/.local/share/applications/postman2.desktop
[Desktop Entry]
Name=Postman
GenericName=API Client
X-GNOME-FullName=Postman API Client
Comment=Make and view REST API calls and responses
Keywords=api;
Exec=/opt/Postman/Postman
Terminal=false
Type=Application
Icon=/opt/Postman/app/resources/app/assets/icon.png
Categories=Development;Utilities;
EOF

chmod +x ~/.local/share/applications/postman2.desktop





