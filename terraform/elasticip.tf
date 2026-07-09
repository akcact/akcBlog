resource "aws_eip" "wordpress" {

  domain = "vpc"

  instance = aws_instance.wordpress.id

  tags = merge(

    local.common_tags,

    {

      Name = "${var.project_name}-eip"

    }

  )

}
