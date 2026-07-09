#############################################
# Security Group
#############################################

resource "aws_security_group" "main" {

  name = "${var.project_name}-sg"

  description = "Security Group for WordPress Server"

  vpc_id = aws_vpc.main.id

  #############################################
  # SSH
  #############################################

  ingress {

    description = "SSH"

    from_port = 22

    to_port = 22

    protocol = "tcp"

    cidr_blocks = [var.my_ip]

  }

  #############################################
  # HTTP
  #############################################

  ingress {

    description = "HTTP"

    from_port = 80

    to_port = 80

    protocol = "tcp"

    cidr_blocks = ["0.0.0.0/0"]

  }

  #############################################
  # HTTPS
  #############################################

  ingress {

    description = "HTTPS"

    from_port = 443

    to_port = 443

    protocol = "tcp"

    cidr_blocks = ["0.0.0.0/0"]

  }

  #############################################
  # Jenkins
  #############################################

  ingress {

    description = "Jenkins"

    from_port = 8081

    to_port = 8081

    protocol = "tcp"

    cidr_blocks = [var.my_ip]

  }

  #############################################
  # Outbound
  #############################################

  egress {

    from_port = 0

    to_port = 0

    protocol = "-1"

    cidr_blocks = ["0.0.0.0/0"]

  }

  tags = merge(

    local.common_tags,

    {

      Name = "${var.project_name}-sg"

    }

  )

}
