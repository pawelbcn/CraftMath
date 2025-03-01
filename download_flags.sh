#!/bin/bash

# Create flags directory if it doesn't exist
mkdir -p flags

# Function to download flag
download_flag() {
    country=$1
    code=$2
    curl -s "https://flagcdn.com/w40/${code}.png" > "flags/${country}.png"
    echo "Downloaded ${country}.png"
}

# Download flags for all supported languages
download_flag "en" "gb"  # English (UK flag)
download_flag "pl" "pl"  # Polish
download_flag "zh" "cn"  # Chinese
download_flag "hi" "in"  # Hindi (India)
download_flag "es" "es"  # Spanish
download_flag "ar" "sa"  # Arabic (Saudi Arabia)
download_flag "bn" "bd"  # Bengali (Bangladesh)
download_flag "fr" "fr"  # French
download_flag "de" "de"  # German
download_flag "it" "it"  # Italian
download_flag "pt" "pt"  # Portuguese
download_flag "nl" "nl"  # Dutch 