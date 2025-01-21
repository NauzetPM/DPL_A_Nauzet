## Paso 1: Instalar Bind9

    Primero, actualiza la lista de paquetes e instala Bind9:
```bash
sudo apt update
sudo apt install bind9 bind9utils bind9-doc dnsutils
```
Asegúrate de que el servicio de Bind9 esté activo y habilitado:
```bash
    sudo systemctl enable bind9
    sudo systemctl start bind9
```
## Paso 2: Configurar el Servidor DNS

    Editar el archivo de configuración principal de Bind9:
```bash
sudo nano /etc/bind/named.conf.local
```
Agrega la siguiente configuración para definir tu zona de dominio. Reemplaza midominio.com con tu propio dominio y ajusta la IP según la configuración de tu servidor:
```bash
zone "midominio.com" {
    type master;
    file "/etc/bind/db.midominio.com";
};
```
Crear el archivo de zona para tu dominio:

Copia el archivo de zona de ejemplo para crear el archivo de zona de tu dominio:
```bash
sudo cp /etc/bind/db.local /etc/bind/db.midominio.com
```
Editar el archivo de zona:

Abre el archivo de zona recién creado:
```bash
sudo nano /etc/bind/db.midominio.com
```
Aquí deberás configurar las direcciones de tu dominio y los registros de recursos (A, MX, etc.). Un ejemplo básico sería:

    ;
    ; Archivo de zona para midominio.com
    ;
```bash
    $TTL    604800
    @       IN      SOA     ns1.midominio.com. root.midominio.com. (
                          2023010101 ; Serial
                          604800     ; Refresh
                          86400      ; Retry
                          2419200    ; Expire
                          604800 )   ; Minimum TTL
    ;
    @       IN      NS      ns1.midominio.com.
    @       IN      NS      ns2.midominio.com.

    @       IN      A       192.168.1.10
    www     IN      A       192.168.1.10
    mail    IN      A       192.168.1.10
    ns1     IN      A       192.168.1.10
    ns2     IN      A       192.168.1.11

    @       IN      MX      10 mail.midominio.com.
```
    Asegúrate de reemplazar las direcciones IP y nombres de host según corresponda a tu configuración.

## Paso 3: Configurar el Servidor DNS para Resolver Peticiones

    Edita el archivo de configuración named.conf.options para permitir la resolución de peticiones externas:
```bash
sudo nano /etc/bind/named.conf.options
```
Asegúrate de que el bloque forwarders esté habilitado con los servidores DNS de tu preferencia, por ejemplo, los de Google:
```bash
    options {
        directory "/var/cache/bind";

        forwarders {
            8.8.8.8;
            8.8.4.4;
        };

        allow-query { any; };
        listen-on { any; };
        listen-on-v6 { any; };
    };
```
    Guarda y cierra el archivo.

## Paso 4: Verificar la Configuración

    Verifica que la configuración de Bind9 no tenga errores:
```bash
sudo named-checkconf
```
Verifica que el archivo de zona también esté correcto:
```bash
    sudo named-checkzone midominio.com /etc/bind/db.midominio.com
```
## Paso 5: Reiniciar el Servicio de Bind9

Una vez que hayas completado la configuración, reinicia Bind9 para que los cambios surtan efecto:
```bash
sudo systemctl restart bind9
```
## Paso 6: Configurar el Firewall (si es necesario)

Si tienes un firewall activado, asegúrate de permitir el tráfico DNS (puerto 53) tanto TCP como UDP:
```bash
sudo ufw allow 53
sudo ufw reload
```
## Paso 7: Configurar los Clientes para Usar tu Servidor DNS

Finalmente, asegúrate de que tus clientes (tanto en la red local como en Internet, si aplica) estén configurados para usar tu servidor DNS. Para hacerlo, configura sus archivos de red o usa el panel de administración del sistema para establecer la IP de tu servidor como servidor DNS principal.

En una red local, configura la dirección IP del servidor en los dispositivos clientes o en el servidor DHCP para asignar automáticamente el servidor DNS.
## Paso 8: Verificar que el DNS Funciona

    Para verificar que el servidor DNS está funcionando correctamente, puedes usar el comando dig:
```bash
dig @192.168.1.10 midominio.com
```
Reemplaza 192.168.1.10 con la IP de tu servidor DNS. Esto debería devolver los registros del dominio configurado.