
# Docker Container/Image Basics
This is a basic step by step intro to working with Docker containers and Images. You should be able to follow along with your installation of docker, but be sure to change IDs/naming schemes according to your use case.

The goal of this exercise is to create a base image from the ubuntu base image that has both the jre and htop installed.

### Start up an ubuntu container to modify, install htop, then exit.
```shell
docker run -t -i ubuntu /bin/bash
```
### Get the ID of the container you just modified.
```shell
docker ps -a
```
### Check out the cool changes you made to the filesystem when you added htop!
```shell
docker diff e22ac97a0748
```
### Start up that container just to make sure the changes are there.

This syntax allows you to attach to an already created container.
```shell
docker start -i -a e22ac97a0748
```
### Commit the container as a new image that you can start containers from.
```shell
docker commit --author='evan' --message='wow added htop' e22ac97a0748 evancoolrepo/htop
```
### Start up a new copy of your fresh image, wow your changes are there, htop starts!
```shell
docker run -t -i evancoolrepo/htop htop
```
### Take a look at the image history so you can visualize what actually went down.
```shell
docker images --tree | grep -C 5 evancoolrepo/htop
```
### We can even look at what happened to generate each layer.
```shell
docker history evancoolrepo/htop
```
### Now we want to install the openjdk-7-jre package to our image, let's pop into it and make some changes, this time we'll name it for simplicity of working with it later.
```shell
docker run -t -i --name='added_the_jre' evancoolrepo/htop /bin/bash
```
### Once you're out let's go ahead and commit this container to a new image that you can spawn more containers from.
```shell
docker commit --author='evan' --message='wow added the jre' added_the_jre evancoolrepo/htopjre
```
### Cool, we can see that we have created the evancoolrepo/htopjre image.
```shell
docker images | sed -e '1p' -e '/evancoolrepo\/htopjre/!d'
```
### That's fancy, but let's look at the tree again.
```shell
docker images --tree | grep -C 8  evancoolrepo/htopjre
```
Output:
```shell
├─d497ad3926c8 Virtual Size: 192.5 MB
│ └─c5fcd5669fa5 Virtual Size: 192.7 MB
│   └─49bb1c57a82c Virtual Size: 192.7 MB
│     └─67983a9b1599 Virtual Size: 192.7 MB
│       └─88fba6f3d2d8 Virtual Size: 192.7 MB
│         └─eca7633ed783 Virtual Size: 192.7 MB Tags: ubuntu:trusty, ubuntu:latest, ubuntu:14.04, ubuntu:14.04.1
│           └─83ba41572d75 Virtual Size: 214.5 MB Tags: evancoolrepo/htop:latest
│             └─5bff31176519 Virtual Size: 579.9 MB Tags: evancoolrepo/htopjre:latest
```
Hmm. We've got excess layers. These add to the size of the `evancoolrepo/htopjre` container and are unnecessary.

# Flatten the new `evancoolrepo/htopjre` with some docker magic.
Start by creating a dummy container to export as a flat container. Without the `-t -i` flags, the container will start and then immediately exit, thereby creating the dummy container we're after.
```shell
docker run --name='dummy_to_flatten' evancoolrepo/htopjre /bin/bash
```

# Verify the dummy container exists.
```shell
docker ps -a | sed -e '1p' -e '/dummy_to_flatten/!d'
```
# DO DOCKER MAGIC!
`docker export` is an amazing command that takes the filesystem of a container and exports it to a tar file over stdout.  
`docker import` is an amazing command that takes a tar file from stdin and creates an image from it.  
When you combine these commands, docker is forced to composite the filesystem of a container to a single layer, and then pop that directly into an image, thus eliminating space wasting intermediary layers as seen a few steps ago.
```shell
docker export dummy_to_flatten | docker import - evancoolrepo/htopjre-flat
```
# Verify the new `evancoolrepo/htopjre-flat` image was created
```shell
docker images | sed -e '1p' -e'/evancoolrepo\/htopjre-flat/!d'
```
# Make sure it still has java and htop installed!
```shell
docker run evancoolrepo/htopjre-flat which java && which htop
```
Should output something like this:
```shell
/usr/bin/java
/usr/bin/htop
```

# Take a look at the new `evancoolrepo/htopjre-flat`'s structure.
```shell
docker images --tree | grep -C 8 evancoolrepo/htopjre-flat
```
Only one layer, same great ubuntu base image, htop and java installed, and 52.9 MB smaller to boot!
