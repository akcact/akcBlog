variable "project_name" {

  description = "Akc Blog"

  type = string

  default = "wordpress-akc"

}

variable "aws_region" {

  description = "AWS Region"

  type = string

  default = "us-east-1"

}

variable "instance_type" {

  description = "EC2 Instance Type"

  type = string

  default = "t2.micro"

}

variable "key_name" {

  description = "wordpress-akc"

  type = string

}

variable "my_ip" {

  description = "34.202.251.117"

  type = string

}
