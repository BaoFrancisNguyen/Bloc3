
FROM php:8.2-apache

# Install system dependencies required for Composer
RUN apt-get update && apt-get install -y libpq-dev\
    sudo \
    git \
    zip \
    unzip \
    python3.10 \
    python3-pip 
    
    
    

# Install Python dependencies
COPY requirements.txt requirements.txt
RUN pip3 install --break-system-packages -r requirements.txt

RUN git clone https://github.com/matplotlib/matplotlib.git
RUN cd matplotlib -m pip install .
RUN git clone https://github.com/mysql/mysql-connector-python.git
RUN cd mysql-connector-python -m pip install .








    
    

# installing additional PHP extensions using 'docker-php-ext-install' followed by the name of the extension

RUN docker-php-ext-install mysqli

# get latest Composer
COPY --from=composer:2.6.5 /usr/bin/composer /usr/bin/composer

# create system user ("bloc3" with uid 1000) 
RUN useradd -G www-data,root -u 1000 -d /home/bloc3 bloc3
RUN mkdir -p /home/bloc3/ && chown -R bloc3:bloc3 /home/bloc3
RUN chown -R bloc3:bloc3 /home/bloc3

# copy existing application directory permissions
COPY --chown=bloc3:bloc3 . /var/www/html

# copy Apache virtual host
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

# enabling Apache mod rewrite
RUN a2enmod rewrite

# changing user 
USER bloc3

# going to app' directory inside container
WORKDIR /var/www/html

# installing Composer deps, the vendor folder will only be populated inside the container
#RUN composer install



# running Apache
CMD apache2-foreground
