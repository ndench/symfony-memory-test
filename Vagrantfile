# -*- mode: ruby -*-
# vi: set ft=ruby :

$once = <<SCRIPT
sudo phpdismod xdebug
sudo systemctl restart php7.3-fpm
make link-var vendor -C /srv/www/app
SCRIPT

Vagrant.configure("2") do |config|
  config.vm.box = "hyraiq/banshee"

  config.vm.network "private_network", ip: "10.1.0.3"
  config.vm.synced_folder "./", "/srv/www/app/current", type: "nfs", mount_options: ["tcp", "actimeo=2", "nolock"]
  config.vm.provision "shell", inline: $once, privileged: false

  config.vm.provider "virtualbox" do |vb|
    vb.name = "symfony-memory-test"
    vb.memory = 2048
    vb.cpus = 2
  end

end
