import qrcode
import os

# eliminar imagen anterior
try:
    os.remove('./public/qr_image.png')
except FileNotFoundError:
    pass


# abrir y leer archivo TXT
file = open('./src/data/data.txt', 'r')
data = file.read()


# generar el QR
qr = qrcode.QRCode(
    version=1,  # tamaño del QR
    error_correction=qrcode.constants.ERROR_CORRECT_L,  # nivel de corrección de errores
    box_size=10,  
    border=4,  
)


qr.add_data(data)
qr.make(fit=True)


# Crear imagen del QR
img = qr.make_image(fill="black", back_color="white")
img.save("./public/qr_image.png")

