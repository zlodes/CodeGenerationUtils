<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace ProxyManagerTest\ProxyGenerator\ValueHolder\PhpMethod;

use ReflectionClass;
use PHPUnit_Framework_TestCase;
use ProxyManager\ProxyGenerator\ValueHolder\PhpMethod\MagicSleep;

/**
 * Tests for {@see \ProxyManager\ProxyGenerator\ValueHolder\PhpMethod\MagicSleep}
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 */
class MagicSleepTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \ProxyManager\ProxyGenerator\ValueHolder\PhpMethod\MagicSleep::__construct
     */
    public function testBodyStructure()
    {
        $reflection  = new ReflectionClass('ProxyManagerTestAsset\\EmptyClass');
        $valueHolder = $this->getMock('CG\\Generator\\PhpProperty');

        $valueHolder->expects($this->any())->method('getName')->will($this->returnValue('bar'));

        $magicSleep = new MagicSleep($reflection, $valueHolder);

        $this->assertSame('__sleep', $magicSleep->getName());
        $this->assertCount(0, $magicSleep->getParameters());
        $this->assertSame(
            "return array('bar');",
            $magicSleep->getBody()
        );
    }
}