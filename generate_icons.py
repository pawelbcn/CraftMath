from PIL import Image
import os

# Create icons directory if it doesn't exist
if not os.path.exists('icons'):
    os.makedirs('icons')

# Base icon size and colors
icon_size = 512
background_color = (92, 92, 92)  # #5c5c5c
text_color = (255, 255, 85)  # #ffff55

# Create a new image with the base size
img = Image.new('RGB', (icon_size, icon_size), background_color)

# Add text "CM" in pixel style
from PIL import ImageDraw

draw = ImageDraw.Draw(img)

# Draw "CM" in pixel art style
def draw_pixel(x, y, size):
    draw.rectangle([x*size, y*size, (x+1)*size-1, (y+1)*size-1], fill=text_color)

# Draw "C"
pixel_size = icon_size // 16
for x, y in [(4,4), (3,5), (3,6), (3,7), (3,8), (3,9), (4,10)]:
    draw_pixel(x, y, pixel_size)

# Draw "M"
for x, y in [(8,4), (9,5), (10,6), (11,5), (12,4), (8,5), (8,6), (8,7), (8,8), (8,9), (8,10), (12,5), (12,6), (12,7), (12,8), (12,9), (12,10)]:
    draw_pixel(x, y, pixel_size)

# Save in different sizes
sizes = [72, 96, 128, 144, 152, 192, 384, 512]

for size in sizes:
    resized = img.resize((size, size), Image.LANCZOS)
    resized.save(f'icons/icon-{size}x{size}.png') 